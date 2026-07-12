<?php

namespace App\Service\impl;

use App\Dto\response\ApiResponseDto;
use App\Enum\AppConstant;
use App\Http\Requests\categoryn\CategoryNSaveRequest;
use App\Mapper\CategoryNMapper;
use App\Models\CategoryN;
use App\Repository\CategoryNDocumentStorageRepository;
use App\Repository\CategoryNRepository;
use App\Service\CategoryNService;
use App\Utils\PaginationUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryNServiceImpl implements CategoryNService
{
    private CategoryNRepository $categoryNRepository;

    private CategoryNDocumentStorageRepository $categoryNDocumentStorageRepository;

    public function __construct(CategoryNRepository $categoryNRepository, CategoryNDocumentStorageRepository $categoryNDocumentStorageRepository)
    {
        $this->categoryNRepository = $categoryNRepository;
        $this->categoryNDocumentStorageRepository = $categoryNDocumentStorageRepository;
    }

    /**
     * Get list category tree
     *
     * @param Request $request
     */
    public function getListDanhMucTinTucTree(Request $request)
    {
        // Get input
        $page = $request->query('PAGE', 1);
        $perPage = $request->query('PER_PAGE', 10);
        $isGetAllElements = $request->input('IS_GET_ALL_ELEMENTS', false);
        if ($isGetAllElements === true) {
            $perPage = 2147483647;  
        }

        $isApiPublic = filter_var($request->input('IS_API_PUBLIC', false), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $resultPagination = $this->categoryNRepository->getListDanhMucTinTucWithChilds($isApiPublic, $page, $perPage);

        // Mapping entity to dto
        $listCategoryNDetailDto = CategoryNMapper::mapListCategoryNDetailFromPaginator($resultPagination->getCollection(), true);
        $resultPagination->setCollection($listCategoryNDetailDto);
        
        // Custom response pagination
        $customResponsePagination = PaginationUtils::pagination($resultPagination);
        
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Truy vấn thành công.'
                , [
                    camelToSnakeUpper(class_basename(CategoryN::class)) => $customResponsePagination
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function getListDanhMucTinTuc(Request $request)
    {
        // Get input
        $isGetAllParentAndChilds = $request->input('IS_GET_ALL_PARENT_AND_CHILDS', false);
        $page = $request->query('PAGE', 1);
        $perPage = $request->query('PER_PAGE', 10);
        $isGetAllElements = $request->input('IS_GET_ALL_ELEMENTS', false);
        if ($isGetAllElements === true) {
            $perPage = 2147483647;  
        }
       
        $parentId = $request->input('PARENT_ID', null);
        $trangThaiHoatDong = $request->input('TRANG_THAI_HOAT_DONG', null);
        $tuKhoa = $request->input('TU_KHOA', null);
        
        $resultPagination = $this->categoryNRepository->getListDanhMucTinTuc($isGetAllParentAndChilds, $parentId, $trangThaiHoatDong, $tuKhoa
            ,$page, $perPage);

        // Mapping entity to dto
        $listProductDto = CategoryNMapper::mapListCategoryNDetailFromPaginator($resultPagination->getCollection());
        $resultPagination->setCollection($listProductDto);

        // Custom response pagination
        $customResponsePagination = PaginationUtils::pagination($resultPagination);
        
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Truy vấn thành công.'
                , [
                    camelToSnakeUpper(class_basename(CategoryN::class)) => $customResponsePagination
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    /**
     * Save category product
     *
     * @param CategoryNSaveRequest $request
     */
    public function save(CategoryNSaveRequest $request)
    {
        // Bắt đầu một transaction
        DB::beginTransaction();

        // Mapper đối tượng
        $data = $request->all();
        $id = isset($data['ID']) ? $data['ID'] : null;
        
        $categoryN = self::getOrNewDanhMucTinTuc($id);
        CategoryNMapper::mapFromArray($categoryN, $data);
        
        // Set SORT_ORDER
        if ($categoryN->ID == null) self::setThuTuSapXep($categoryN);
        
        // Save
        $categoryN = $this->categoryNRepository->save($categoryN->toArray());
        $categoryN = is_null($id) ? $categoryN : $categoryN->first();

        // Update tất cả record nào đang sử dụng parent_id này về null
        // $this->categoryNRepository->updateParentIdToNullById($categoryN->ID);

        // Xóa document storage by category-p id
        self::deleteAllDanhMucTinTucFileDinhKem($categoryN->ID);
        
        // Xử lý lưu danh sách hình ảnh đại diện upload vào database
        $danhSachHinhAnhDaiDienUpload = $request->input('DANH_SACH_HINH_ANH_DAI_DIEN', null);
        if (!is_null($danhSachHinhAnhDaiDienUpload) && count($danhSachHinhAnhDaiDienUpload) > 0) {
            // Lưu hình ảnh vào database
            self::handleSaveFileDinhKem($categoryN->ID, $danhSachHinhAnhDaiDienUpload);
        }

        // Log
        Log::info("CategoryN ID {$categoryN->ID} save successfully!");
        
        // Nếu mọi thứ thành công, commit transaction
        DB::commit();

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , is_null($id) ? 'Tạo mới thành công.' : 'Cập nhật thành công.'
                , [
                    class_basename(CategoryN::class) => $categoryN
                ]
                )
            )->setStatusCode(JsonResponse::HTTP_OK);
    }

    private function handleSaveFileDinhKem($categoryNId, array $documentStorages) {
        // Lưu document storages
        if (isset($documentStorages) && count($documentStorages) > 0) {
            $this->categoryNDocumentStorageRepository->saveCategoryNDocumentStorages($categoryNId, $documentStorages);
        }
    }

    /**
     * Set sort order
     * 
     * @param CategoryN $categoryN
     */
    public function setThuTuSapXep(CategoryN $categoryN) {
        $categoryN->SORT_ORDER = self::getThuTuSapXepMoiNhat();
    }

    /**
     * Get sort order lastest
     *
     * @param CategoryN $categoryN
     */
    public function getThuTuSapXepMoiNhat()
    {
        $sortOrder = $this->categoryNRepository->getSortOrder() + 1;
        Log::info("Sort order $sortOrder");
        return $sortOrder;
    }

    /**
     * Get or new categor product
     *
     * @param int $id
     * @return CategoryN
     */
    public function getOrNewDanhMucTinTuc($id): CategoryN
    {
        $categoryN = ($id != null) ? $this->categoryNRepository->find($id)->first() : new CategoryN();
        return $categoryN;
    }

    public function deleteAllDanhMucTinTucFileDinhKem($categoryNId) : bool
    {
        // Xóa document storage by category-n id
        return $this->categoryNDocumentStorageRepository->deleteAllDanhMucTinTucFileDinhKem($categoryNId);
    }

    public function getDetailDanhMucTinTuc($id, Request $request)
    {
        $categoryN = $this->categoryNRepository->getDetailDanhMucTinTuc($id);
        // Lấy thêm thông tin query document storages
        $categoryN->avatars;


        // Mapping entity to dto
        $categoryNPDetailDto = CategoryNMapper::mapCategoryNDetailFromEntity($categoryN);
        
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Truy vấn thành công.'
                , [
                    camelToSnakeUpper(class_basename(CategoryN::class)) => $categoryNPDetailDto
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function deleteDanhMucTinTuc($id, Request $request)
    {
        // Bắt đầu một transaction
        DB::beginTransaction();

        // Xóa mềm category product
        $categoryN = self::getOrNewDanhMucTinTuc($id);
        $categoryN->STATUS = AppConstant::STATUS_DELETED;
        $categoryN->save();

        // Xóa cứng pivot table category_n_document_storages
        // self::deleteAllDanhMucTinTucFileDinhKem($id);

        // Nếu mọi thứ thành công, commit transaction
        DB::commit();

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Xóa thành công.'
                , [
                    class_basename(CategoryN::class) => null
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function activeTrangThaiHoatDong($id, Request $request)
    {
        // Bắt đầu một transaction
        DB::beginTransaction();
        
        // Get thông tin chi tiết category product
        $categoryN = $this->categoryNRepository->getDetailDanhMucTinTuc($id);
        $categoryN->IS_ACTIVE = filter_var($request->input('IS_ACTIVE') ?? true, FILTER_VALIDATE_BOOLEAN);
        $categoryN->save();

        // Nếu mọi thứ thành công, commit transaction
        DB::commit();

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Chuyển đổi trạng thái thành công.'
                , [
                    class_basename(CategoryN::class) => null
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }


}
