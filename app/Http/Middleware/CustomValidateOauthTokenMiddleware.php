<?php

namespace App\Http\Middleware;

use App\Enum\AppConstant;
use App\Exceptions\UnauthorizedException;
use App\Service\AuthService;
use App\Service\UserService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\TokenRepository;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class CustomValidateOauthTokenMiddleware
{
    private AuthService $authService;
    private TokenRepository $tokens;
    private UserService $userService;

    public function __construct(AuthService $authService, TokenRepository $tokens, UserService $userService)
    {
        $this->authService = $authService;
        $this->tokens = $tokens;
        $this->userService = $userService;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $accessToken = $request->header('Authorization', null);
        if (empty($accessToken) || !Str::startsWith($accessToken, 'Bearer ')) {
            $errors = [
                'MSG' => 'Token không hợp lệ hoặc đã hết hạn. Vui lòng đăng nhập lại.'
            ];
            throw new UnauthorizedException($errors, 'Token không hợp lệ hoặc đã hết hạn. Vui lòng đăng nhập lại.');
        }
        $accessToken = Str::after($accessToken, 'Bearer ');
        
        // Validate access token
        $validateAccessTokenDto = $this->authService->validateAccessToken($accessToken);
        if (!$validateAccessTokenDto->isValid) { // Không hợp lệ hoặc không đúng nghiệp vụ validate thông tin user
            $errors = [
                'MSG' => 'Token không hợp lệ hoặc đã hết hạn. Vui lòng đăng nhập lại.'
            ];
            throw new UnauthorizedException($errors, 'Token không hợp lệ hoặc đã hết hạn. Vui lòng đăng nhập lại.');
        } else {
            $validRequest = $validateAccessTokenDto->validRequest;
            // IMPORTANT - Validate the request using Passport's ResourceServer
            $oauthAccessTokenId = $validRequest->getAttribute('oauth_access_token_id');
            // Get oauthClientId
            $oauthClientId = $validRequest->getAttribute('oauth_client_id');
            // Get oauth scopes[]
            $oauthScopes = $validRequest->getAttribute('oauth_scopes');
            // Get the user ID
            $userId = $validRequest->getAttribute('oauth_user_id');

            // Set vào security của Laravel. 
            // Sau này có thể sử dụng, ở các service khác như: 
            // auth()->user() hoặc Auth::user() hoặc $request->user()
            $user = $this->authService->validateUser($userId);
            
            try {
                // Gán vào Auth
                $accessToken = $this->tokens->find($oauthAccessTokenId);
                $user->A = 'B'; // Có thể gắn các properties vào đây để sử dụng khi retrieve Auth ra
                $user->token = $accessToken;
                $user->PERMISSIONS =  $user->permissions();
                Auth::setUser($user); // IMPORTANT - Gán user vào security context
            } catch (\Throwable $th) {
                //throw $th;
                Log::error($th);
                $errors = [
                    'MSG' => 'Token không hợp lệ hoặc đã hết hạn. Vui lòng đăng nhập lại.'
                ];
                throw new UnauthorizedException($errors, $errors['MSG']);
            }

        }

        return $next($request);
    }
}
