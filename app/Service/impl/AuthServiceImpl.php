<?php

namespace App\Service\impl;

use App\Dto\auth\ValidateAccessTokenDto;
use App\Dto\product\ProductDetailDto;
use App\Dto\response\ApiResponseDto;
use App\Enum\AppConstant;
use App\Enum\TitleEnum;
use App\Exceptions\BadRequestException;
use App\Exceptions\UnauthorizedException;
use App\Mapper\UserMapper;
use App\Models\OauthClient;
use App\Models\User;
use App\Repository\OauthClientRepository;
use App\Repository\TitleRepository;
use App\Repository\UserRepository;
use App\Service\AuthService;
use App\Service\MailService;
use App\Service\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\Exceptions\AuthenticationException;
use Laravel\Passport\TokenRepository;
use League\OAuth2\Server\ResourceServer;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use stdClass;

use function PHPUnit\Framework\isNull;

class AuthServiceImpl implements AuthService
{
    private UserRepository $userRepository;
    
    private OauthClientRepository $oauthClientRepository;

    private TitleRepository $titleRepository;

    private MailService $mailService;

    // Inject beans có sẵn ở Oauth2 Passport
    private ResourceServer $server;
    private UserService $userService;

    /**
     * Create a new class instance.
     */
    public function __construct(UserRepository $userRepository, OauthClientRepository $oauthClientRepository, TitleRepository $titleRepository
        , MailService $mailService
        , ResourceServer $server, UserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->oauthClientRepository = $oauthClientRepository;
        $this->titleRepository = $titleRepository;
        $this->mailService = $mailService;
        $this->server = $server;
        $this->userService = $userService;
    }

    public function registerUser(Request $request) {
        // Bắt đầu một Transaction
        DB::beginTransaction();

        // Mapper đối tượng
        $data = $request->all();
        $data['PASSWORD'] = bcrypt($data['PASSWORD']);
        $data['TRANG_THAI_HOAT_DONG'] = false;
        $user = new User();
        UserMapper::mapFromArray($user, $data);

        // Save
        $user = $this->userRepository->save($user->toArray());
        // Save title - Chức danh
        $this->titleRepository->createTitle($user->ID, TitleEnum::TITLE_ROLE_CHUYEN_VIEN);
        // Save User_Profile
        $request->merge([
            'USER_ID' => $user->ID
        ]);
        $this->userRepository->updateMyInfo($request->input('EMAIL'), $request);

        // Generate token
        $token = $user->createToken('Web')->accessToken;
        $user['TOKEN'] = $token;

        // Nếu mọi thứ thành công, commit transaction
        DB::commit();

        // Log
        Log::info("User ID {$user->ID} register successfully!");

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Đăng ký tài khoản thành công.<br> Vui lòng đợi Admin phê duyệt!'
                , [
                    class_basename(User::class) => $user
                ]
                )
            )->setStatusCode(JsonResponse::HTTP_OK);
    }
    
    public function loginUser(Request $request) {
        $user = $this->userRepository->getDetailUser($request->input('EMAIL'));

        if (is_null($user) || !Hash::check($request->input('PASSWORD'), $user->PASSWORD)) {
            $errors = [
                'PASSWORD' => ['Sai mật khẩu.']
            ];
            throw new BadRequestException($errors, 'Sai mật khẩu.');
        }

        $isActive = filter_var($user->IS_ACTIVE, FILTER_VALIDATE_BOOLEAN) ?? false;
        if ($isActive === false) {
            $errors = [
                'PASSWORD' => ['Sai mật khẩu.']
            ];
            throw new BadRequestException($errors, 'Tài khoản chưa được kích hoạt.<br> Vui lòng liên hệ Admin');
        }
        
        // Tạo token cho người dùng đăng nhập
        // $token = $user->createToken('Web')->accessToken;

        // Lấy thông tin oauthClients with grant password
        $collectOauthClientWithGrantPassword = $this->oauthClientRepository->getListOauthClientWithGrantPasswordClient();
        if ($collectOauthClientWithGrantPassword->isEmpty()) {
            $errors = [
                'LOGIN' => ['Lỗi truy vấn oauth client.']
            ];
            throw new BadRequestException($errors, 'Lỗi truy vấn oauth client.');
        }
        $oauthClientWithGrantPassword = $collectOauthClientWithGrantPassword->first();

        // Gọi api oauth/token với grant_type Password để sinh ra token và refresh_token
        $responseOauth = Http::asForm()->post(url('oauth/token'), [
            "grant_type"=> AppConstant::GRANT_TYPES['PASSWORD'],
            "client_id"=> $oauthClientWithGrantPassword->id,
            "client_secret"=> $oauthClientWithGrantPassword->secret,
            "username"=> $request->input('EMAIL'), // Fix: Use EMAIL instead of USERNAME
            "password"=> $request->input('PASSWORD'),
            "scope"=> ""
        ]);

        if ($responseOauth->failed()) {
            $errors = [
                'LOGIN' => ['Lỗi đăng nhập.']
            ];
            throw new BadRequestException($errors, 'Lỗi đăng nhập.');
        }

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Đăng nhập thành công.'
                , [
                    'token_type' => $responseOauth['token_type'],
                    'access_token' => $responseOauth['access_token'],
                    'refresh_token' => $responseOauth['refresh_token'],
                    'expires_in' => now()->addSeconds($responseOauth['expires_in'])->toDateTimeString()
                ]
                )
            )->setStatusCode(JsonResponse::HTTP_OK)
            // MÃ HÓA GIÁ TRỊ COOKIE để Laravel có thể giải mã ở web middleware
            ->cookie(AppConstant::COOKIE_SKIP_COUNT_VIEW_WEBSITE, encrypt('1'), 60 * 24 * 30);
    }

    public function refreshToken(Request $request) {
        // Check kiểm tra refresh_token có hợp lệ không
        $refreshToken = $request->input('REFRESH_TOKEN');

        // Lấy thông tin oauthClients with grant password
        $collectOauthClientWithGrantPassword = $this->oauthClientRepository->getListOauthClientWithGrantPasswordClient();
        if ($collectOauthClientWithGrantPassword->isEmpty()) {
            $errors = [
                'LOGIN' => ['Lỗi truy vấn oauth client.']
            ];
            throw new UnauthorizedException($errors, 'Lỗi truy vấn oauth client.');
        }
        $oauthClientWithGrantPassword = $collectOauthClientWithGrantPassword->first();

        // Gọi api oauth/token với grant_type refresh_token để sinh ra Access_token
        $responseOauth = Http::asForm()->post(url('oauth/token'), [
            "grant_type"=> AppConstant::GRANT_TYPES['REFRESH_TOKEN'],
            "client_id"=> $oauthClientWithGrantPassword->id,
            "client_secret"=> $oauthClientWithGrantPassword->secret,
            "refresh_token"=> $refreshToken,
            "scope"=> ""
        ]);

        if ($responseOauth->failed()) {
            $errors = [
                'LOGIN' => ['Lỗi refresh token thất bại.']
            ];
            throw new UnauthorizedException($errors, $errors['LOGIN']);
        }

        // Validate xem thử user này có còn hợp lệ hay không
        $newAccessToken = $responseOauth['access_token'];
        $validateAccessTokenDto = $this->validateAccessToken($newAccessToken);
        $validRequest = $validateAccessTokenDto->validRequest;
        // Get oauth token infos
        $oauthAccessTokenId = $validRequest->getAttribute('oauth_access_token_id');
        // Get oauthClientId
        $oauthClientId = $validRequest->getAttribute('oauth_client_id');
        // Get oauth scopes[]
        $oauthScopes = $validRequest->getAttribute('oauth_scopes');
        // Get the user ID
        $userId = $validRequest->getAttribute('oauth_user_id');

        // Validate user
        try {
            $user = $this->validateUser($userId);
        } catch (\Throwable $th) {
            // Thu hồi delete AccessToken và RefreshToken vừa cấp
            $this->deleteAccessTokenAndRefreshToken($oauthAccessTokenId);
            throw $th;
        }

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Refresh token thành công.'
                , [
                    'token_type' => $responseOauth['token_type'],
                    'access_token' => $responseOauth['access_token'],
                    'refresh_token' => $responseOauth['refresh_token'],
                    'expires_in' => $responseOauth['expires_in']
                ]
                )
            )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function logoutUser(Request $request) {
        // Bắt đầu một Transaction
        DB::beginTransaction();
        $accessToken = $request->user()->token;
        // Xóa refresh_token tương ứng với access_token_id
        DB::table('oauth_refresh_tokens')
            ->where([
                ['access_token_id', $accessToken->id]
            ])
            ->delete();

        // Delete oauth_access_token hiện tại
        $accessToken->delete();

        // Hoặc chỉ revoke oauth_access_token hiện tại
        // $accessToken->revoke();

        DB::commit();

        // Trả về response JSON và xóa cookie phía client ngay trong response
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS, 'Đăng xuất thành công.', [])
        )->setStatusCode(JsonResponse::HTTP_OK)
         ->cookie(Cookie::forget(AppConstant::COOKIE_SKIP_COUNT_VIEW_WEBSITE));
    }

    public function deleteAccessTokenAndRefreshToken(string $accessTokenId) {
        // Bắt đầu một Transaction
        DB::beginTransaction();
        // Xóa refresh_token tương ứng với access_token_id
        DB::table('oauth_refresh_tokens')
            ->where([
                ['access_token_id', $accessTokenId]
            ])
            ->delete();

        // Delete oauth_access_token hiện tại
        DB::table('oauth_access_tokens')
            ->where([
                ['id', $accessTokenId]
            ])
            ->delete();

        // Hoặc chỉ revoke oauth_access_token hiện tại
        // $accessToken->revoke();

        DB::commit();
    }

    public function myInfo(Request $request) {
        $currUser = $this->getCurrUser();

        return response()->json(
            new ApiResponseDto(
                AppConstant::STATUS_SUCCESS,
                'Truy vấn thành công.',
                [
                    camelToSnakeUpper(class_basename(User::class))
                        => UserMapper::mapUserDetailDtoFromEntity($currUser, true)
                ],
                JsonResponse::HTTP_OK
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function updateMyInfo(Request $request) {
        // Bắt đầu một Transaction
        DB::beginTransaction();
        $currUser = $this->getCurrUser();
        $request->merge([
            'USER_ID' => $currUser->ID
        ]);
        $this->userRepository->updateMyInfo($currUser->EMAIL, $request);
        
        DB::commit();
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Cập nhật thành công.'
                , [
                    camelToSnakeUpper(class_basename(User::class)) => $this->userService->getUserById($request->input('USER_ID'))
                ]
                )
            )->setStatusCode(JsonResponse::HTTP_OK);
    }
    
    public function updatePassword(Request $request) {
        // Bắt đầu một Transaction
        DB::beginTransaction();
        $currUser = $this->getCurrUser();
        $user = $this->userRepository->getDetailUser($currUser->EMAIL);
        $isMatchOldPassword = Hash::check($request->input('OLD_PASSWORD'), $user->PASSWORD);
        if ($isMatchOldPassword === false) {
            $errors = [
                'OLD_PASSWORD' => ['Sai mật khẩu.']
            ];
            throw new BadRequestException($errors, 'Sai mật khẩu.');
        }
        $newPassword = bcrypt($request->input('NEW_PASSWORD'));
        $request->merge([
            'NEW_PASSWORD' => $newPassword
        ]);
        $this->userRepository->updatePassword($currUser->EMAIL, $request);
        DB::commit();

        return response()->json(
            new ApiResponseDto(
                AppConstant::STATUS_SUCCESS,
                'Đổi mật khẩu thành công.',
                [
                    camelToSnakeUpper(class_basename(User::class))
                        => UserMapper::mapUserDetailDtoFromEntity($currUser)
                ],
                JsonResponse::HTTP_OK
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function forgotPassword(Request $request) {
        $user = $this->userRepository->getDetailUser($request->input('EMAIL'));
        if (!is_null($user->RESET_DATE) && now()->diffInMinutes($user->RESET_DATE, true) <= 5) {
            $errors = [
            ];
            throw new BadRequestException($errors, 'Vui lòng thử lại sau 5 phút nữa.');
        }
        $user->RESET_KEY = bcrypt($request->input('EMAIL'));
        $user->RESET_DATE = now();
        $user->save();

        // Send Email
        $urlResetPassword = url('/admin/reset-password?reset_key=' . $user->RESET_KEY);
        $this->mailService->sendMailResetPassword($request->input('EMAIL'), $urlResetPassword);

        return response()->json(
            new ApiResponseDto(
                AppConstant::STATUS_SUCCESS,
                'Reset mật khẩu thành công.<br>Vui lòng kiểm tra email!',
                [
                    camelToSnakeUpper(class_basename(User::class))
                        => null
                ],
                JsonResponse::HTTP_OK
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }
    
    public function getCurrUser() : ?User {
        return Auth::user();
    }

    public function validateAccessToken(String $accessToken) : ValidateAccessTokenDto {
        // Convert Laravel Request to PSR-7
        $psr17Factory = new Psr17Factory();
        // Dùng để tạo đối tượng request PSR-7 (chuẩn cho Laravel Passport xử lý token).
        $creator = new ServerRequestCreator(
            $psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory
        );
        $psrRequest = $creator->fromGlobals();
        // Gắn AccessToken vafo header Authorization
        $psrRequest = $psrRequest->withHeader('Authorization', 'Bearer ' . $accessToken);

        // Validate access token
        // IMPORTANT - Validate the request using Passport's ResourceServer
        try {
            $validatedRequest = $this->server->validateAuthenticatedRequest($psrRequest);
            return new ValidateAccessTokenDto(true, $validatedRequest);
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th);
            return new ValidateAccessTokenDto(false, null);
        }    
    }

    public function validateUser(int $userId) : User {
        $user = $this->userService->getUserById($userId);
        if (is_null($user)) {
            $errors = [
                'MSG' => 'Không tồn tại tài khoản này hoặc đang tạm khóa. Vui lòng liên hệ Quản Trị Viên hoặc đăng nhập lại.'
            ];
            throw new UnauthorizedException($errors, $errors['MSG']);
        }
        if ($user->STATUS !== AppConstant::STATUS_USING) {
            $errors = [
                'MSG' => 'Tài khoản đang không hoạt đông. Vui lòng liên hệ Quản Trị Viên.'
            ];
            throw new UnauthorizedException($errors, $errors['MSG']);
        }
        return $user;
    }

    public function getUserByResetKey(Request $request) {
        $user = $this->userRepository->getUserByResetKey($request->input('RESET_KEY'));

        if (!is_null($user->RESET_DATE) && now()->diffInMinutes($user->RESET_DATE, true) > 5) {
            $errors = [
            ];
            throw new BadRequestException($errors, 'Yêu cầu reset mật khẩu không hợp lệ hoặc đã hết hạn!');
        }

        return response()->json(
            new ApiResponseDto(
                AppConstant::STATUS_SUCCESS,
                'Truy vấn thành công.',
                [
                    camelToSnakeUpper(class_basename(User::class))
                        => UserMapper::mapUserDetailDtoFromEntity($user)
                ],
                JsonResponse::HTTP_OK
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function resetPasswordByResetKey(Request $request) {
        // Bắt đầu một Transaction
        DB::beginTransaction();
        $user = $this->userRepository->getUserByResetKey($request->input('RESET_KEY'));

        if (!is_null($user->RESET_DATE) && now()->diffInMinutes($user->RESET_DATE, true) > 5) {
            $errors = [
            ];
            throw new BadRequestException($errors, 'Yêu cầu reset mật khẩu không hợp lệ hoặc đã hết hạn!');
        }
        
        $newPassword = bcrypt($request->input('NEW_PASSWORD'));
        $request->merge([
            'NEW_PASSWORD' => $newPassword
        ]);
        $this->userRepository->updatePassword($user->EMAIL, $request);
        $user->RESET_KEY = null;
        $user->RESET_DATE = null;
        $user->save();
        DB::commit();

        return response()->json(
            new ApiResponseDto(
                AppConstant::STATUS_SUCCESS,
                'Đổi mật khẩu thành công.',
                [
                    camelToSnakeUpper(class_basename(User::class))
                        => UserMapper::mapUserDetailDtoFromEntity($user)
                ],
                JsonResponse::HTTP_OK
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }
}

