<?php

namespace App\Service\impl;

use App\Dto\response\ApiResponseDto;
use App\Enum\AppConstant;
use App\Enum\TitleEnum;
use App\Mapper\DocumentStorageMapper;
use App\Mapper\TitleMapper;
use App\Mapper\UserMapper;
use App\Models\User;
use App\Repository\TitleRepository;
use App\Repository\UserRepository;
use App\Service\DocumentStorageService;
use App\Service\TitleService;
use App\Service\UserService;
use App\Utils\PaginationUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserServiceImpl implements UserService
{
    // Inject beans
    private UserRepository $userRepository;
    private DocumentStorageService $documentStorageService;
    private TitleService $titleService;
    private TitleRepository $titleRepository;

    public function __construct(UserRepository $userRepository, DocumentStorageService $documentStorageService, TitleService $titleService
        , TitleRepository $titleRepository)
    {
        $this->userRepository = $userRepository;
        $this->documentStorageService = $documentStorageService;
        $this->titleService = $titleService;
        $this->titleRepository = $titleRepository;
    }

    public function getUserById(int $id) : ?User {
        $user = $this->userRepository->getUserById($id);
        $hinhAnhDaiDien = null;
        if (isset($user->AVATAR_ID) && !is_null($user->AVATAR_ID)) {
            $documentStorage = $this->documentStorageService->getFileDinhKemById($user->AVATAR_ID, AppConstant::STATUS_USING);
            $hinhAnhDaiDien = DocumentStorageMapper::mapDocumentStorageDetailFromEntity($documentStorage);
        }
        $user->HINH_ANH_DAI_DIEN = $hinhAnhDaiDien;

        $currTileActived = $this->titleService->getTilteActiveByUserId($user->ID);
        $user->TITLE = TitleMapper::maptitileDetailDtoDtoFromEntity($currTileActived);
        
        return $user;
    }

    public function getUserByResetKey(string $resetKey) : ?User {
        return $this->userRepository->getUserByResetKey($resetKey);
    }
    
    public function getListUser(Request $request) {
        $draw = $request->input('DRAW', 1);
        $page = $request->query('PAGE', 1);
        $perPage = $request->query('PER_PAGE', 10);
        $isGetAllElements = filter_var($request->query('IS_GET_ALL_ELEMENTS', false), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        if ($isGetAllElements === true) {
            $perPage = 2147483647;  
        }
        $tuKhoa = $request->input('TU_KHOA', null);
        $trangThaiHoatDong = $request->input('TRANG_THAI_HOAT_DONG', null);
        $vaiTroId = $request->input('VAI_TRO_ID', null);
        $isApiPublic = filter_var($request->input('IS_API_PUBLIC', false), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        $resultPagination = $this->userRepository->getListUser($tuKhoa, $trangThaiHoatDong, $vaiTroId, $isApiPublic
            , $page, $perPage);

        // Set hình ảnh đại diện
        foreach ($resultPagination->getCollection() as $key => $user) {
            $hinhAnhDaiDien = null;
            if (isset($user->AVATAR_ID) && !is_null($user->AVATAR_ID)) {
                $documentStorage = $this->documentStorageService->getFileDinhKemById($user->AVATAR_ID, AppConstant::STATUS_USING);
                $hinhAnhDaiDien = DocumentStorageMapper::mapDocumentStorageDetailFromEntity($documentStorage);
            }
            $user->HINH_ANH_DAI_DIEN = $hinhAnhDaiDien;
        }

        // Mapping entity to dto
        $listUserDto = UserMapper::mapListUserDetailFromPaginator($resultPagination->getCollection());
        $resultPagination->setCollection($listUserDto);

        // Custom response pagination
        $customResponsePagination = PaginationUtils::pagination($resultPagination);
        $customResponsePagination['DRAW'] = $draw;

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Truy vấn thành công.'
                , [
                    camelToSnakeUpper(class_basename(User::class)) => $customResponsePagination
                ]
                , JsonResponse::HTTP_OK
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }
    
    public function activeUser($id, Request $request) {
        // Bắt đầu một transaction
        DB::beginTransaction();
        
        // Get thông tin chi tiết user
        $user = $this->userRepository->getUserById($id);
        $user->IS_ACTIVE = filter_var($request->input('IS_ACTIVE') ?? true, FILTER_VALIDATE_BOOLEAN);
        $user->save();

        // Nếu mọi thứ thành công, commit transaction
        DB::commit();

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Chuyển đổi trạng thái thành công.'
                , [
                    class_basename(User::class) => null
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function deleteUser($id, Request $request) {
        // Bắt đầu một transaction
        DB::beginTransaction();

        // Xóa mềm user
        $user = $this->userRepository->getUserById($id);
        $user->STATUS = AppConstant::STATUS_DELETED;
        $user->save();

        // Nếu mọi thứ thành công, commit transaction
        DB::commit();

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Xóa thành công.'
                , [
                    camelToSnakeUpper(class_basename(User::class)) => null
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function getUserByIdRspApi(int $id) {
        $user =  self::getUserById($id);
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Truy vấn thành công.'
                , [
                    camelToSnakeUpper(class_basename(User::class)) => UserMapper::mapUserDetailDtoFromEntity($user, false)
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function createUser(Request $request) {
        // Bắt đầu một Transaction
        DB::beginTransaction();
        
        // Create new user
        $data = $request->all();
        $data['PASSWORD'] = bcrypt($data['NEW_PASSWORD']);
        $data['USERNAME'] = $data['EMAIL']; // Set USERNAME same as EMAIL
        $data['TRANG_THAI_HOAT_DONG'] = true; // Auto activate for admin created users
        $user = new User();
        UserMapper::mapFromArray($user, $data);
        $user = $this->userRepository->save($user->toArray());
        
        // Save title - Chức danh
        $titleEnum = TitleEnum::getTitleEnumByRoleId($request->VAI_TRO_ID);
        $this->titleRepository->createTitle($user->ID, $titleEnum);
        
        // Save User_Profile
        $request->merge([
            'USER_ID' => $user->ID
        ]);
        $this->userRepository->updateMyInfo($user->EMAIL, $request);
        
        DB::commit();
        
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Tạo người dùng thành công.'
                , [
                    camelToSnakeUpper(class_basename(User::class)) => self::getUserById($user->ID)
                ]
                )
            )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function updateUser($id, Request $request) {
        // Bắt đầu một Transaction
        DB::beginTransaction();
        $user = self::getUserById($id);
        $request->merge([
            'USER_ID' => $user->ID
        ]);
        $this->userRepository->updateMyInfo($user->EMAIL, $request);

        // Save title - Chức danh
        if ($id !== "1") { // Khác SupperAdmin thì mới cho đổi Vai trò
            // Xóa cứng title trước đó
            $this->titleRepository->hardDeleteTitlesByUserId($user->ID);
            $titleEnum = TitleEnum::getTitleEnumByRoleId($request->VAI_TRO_ID);
            $this->titleRepository->createTitle($user->ID, $titleEnum);
        }

        // Cập nhật password nếu tồn tại
        if (!is_null($request->input('NEW_PASSWORD'))) {
            $newPassword = bcrypt($request->input('NEW_PASSWORD'));
            $request->merge([
                'NEW_PASSWORD' => $newPassword
            ]);
            $this->userRepository->updatePassword($user->EMAIL, $request);
        }
        
        
        DB::commit();
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Cập nhật thành công.'
                , [
                    camelToSnakeUpper(class_basename(User::class)) => self::getUserById($request->input('USER_ID'))
                ]
                )
            )->setStatusCode(JsonResponse::HTTP_OK);
    }
}
