<?php

namespace App\Service\impl;

use App\Dto\news\NewsDetailDto;
use App\Dto\response\ApiResponseDto;
use App\Enum\AppConstant;
use App\Mapper\NewsMapper;
use App\Models\News;
use App\Models\NewsCategory;
use App\Repository\NewsCategoryRepository;
use App\Repository\NewsDocumentStorageRepository;
use App\Repository\NewsRepository;
use App\Service\NewsService;
use App\Utils\PaginationUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsServiceImpl implements NewsService
{
    // Inject beans
    private NewsRepository $newsRepository;
    private NewsDocumentStorageRepository $newsDocumentStorageRepository;
    private NewsCategoryRepository $newsCategoryRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(
        NewsRepository $newsRepository,
        NewsDocumentStorageRepository $newsDocumentStorageRepository,
        NewsCategoryRepository $newsCategoryRepository
    ) {
        $this->newsRepository = $newsRepository;
        $this->newsDocumentStorageRepository = $newsDocumentStorageRepository;
        $this->newsCategoryRepository = $newsCategoryRepository;
    }

    public function getOrNewTinTuc($id): News
    {
        $news = ($id != null) ? $this->newsRepository->getDetailTinTuc($id) : new News();
        return $news;
    }

    public function getOrNewTinTucWithFetchEdger($id): News
    {
        $news = ($id != null) ? $this->newsRepository->getDetailTinTucWithFetchEdger($id) : new News();
        return $news;
    }

    public function handleSaveFileDinhKem($newsId,  array $documentStorages)
    {
        if (isset($documentStorages) && count($documentStorages) > 0) {
            $this->newsDocumentStorageRepository->saveNewsDocumentStorages($newsId, $documentStorages);
        }
    }

    public function deleteAllTinTucFileDinhKems($newsId): bool
    {
        return $this->newsDocumentStorageRepository->deleteAllTinTucFileDinhKems($newsId);
    }

    public function handleSaveDanhMucTinTucs($newsId,  array $categories)
    {
        self::deleteAllTinTucDanhMucTinTuc($newsId);
        if (isset($categories) && count($categories) > 0) {
            $this->newsCategoryRepository->saveNewsCategories($newsId, $categories);
        }
    }

    public function deleteAllTinTucDanhMucTinTuc($newsId): bool
    {
        return $this->newsCategoryRepository->deleteAllTinTucDanhMucTinTuc($newsId);
    }

    public function saveTinTuc(Request $request)
    {
        $id = $request->input('ID', null);
        DB::beginTransaction();
        $data = $request->all();
        $news = self::getOrNewTinTuc($id);
        NewsMapper::mapFromArray($news, $data);
        $news->ATTR49 = AppConstant::TYPE_NEWS_COMMON;
        $news->ATTR50 = AppConstant::PATH_CHI_TIET_NEWS_COMMON;
        $arrNews = $news->toArray();
        $news = $this->newsRepository->save($arrNews);
        $news = is_null($id) ? $news : $news->first();
        $arrDanhMucTinTuc = [
            [
                'NEWS_ID' => $news->ID,
                'CATEGORY_ID' => $request->input('DANH_MUC_TIN_TUC.ID'),
                'IS_ACTIVE' => true
            ]
        ];
        self::handleSaveDanhMucTinTucs($news->ID, $arrDanhMucTinTuc);
        self::deleteAllTinTucFileDinhKems($news->ID);
        $danhSachHinhAnhDaiDienUpload = $request->input('DANH_SACH_HINH_ANH_DAI_DIEN', null);
        if (!is_null($danhSachHinhAnhDaiDienUpload) && count($danhSachHinhAnhDaiDienUpload) > 0) {
            self::handleSaveFileDinhKem($news->ID, $danhSachHinhAnhDaiDienUpload);
        }
        $danhSachHinhAnhUpload = $request->input('DANH_SACH_HINH_ANH', null);
        if (!is_null($danhSachHinhAnhUpload) && count($danhSachHinhAnhUpload) > 0) {
            self::handleSaveFileDinhKem($news->ID, $danhSachHinhAnhUpload);
        }
        $danhSachVideoUpload = $request->input('DANH_SACH_VIDEO', null);
        if (!is_null($danhSachVideoUpload) && count($danhSachVideoUpload) > 0) {
            self::handleSaveFileDinhKem($news->ID, $danhSachVideoUpload);
        }
        $danhSachFileDinhKemUpload = $request->input('DANH_SACH_FILE_DINH_KEM', null);
        if (!is_null($danhSachFileDinhKemUpload) && count($danhSachFileDinhKemUpload) > 0) {
            self::handleSaveFileDinhKem($news->ID, $danhSachFileDinhKemUpload);
        }
        DB::commit();
        return response()->json(
            new ApiResponseDto(
                AppConstant::STATUS_SUCCESS,
                is_null($id) ? 'Tạo mới thành công.' : 'Cập nhật thành công.',
                [
                    camelToSnakeUpper(class_basename(News::class))
                        => new NewsDetailDto($news->ID, $news->TITLE, convertStrToSlug($news->TITLE))
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function getDetailTinTuc($id, Request $request) {
        $news = $this->newsRepository->getDetailTinTucWithFetchEdger($id);
        $tinTucDetail = null;
        switch ($news->ATTR49) {
            case AppConstant::TYPE_NEWS_COMMON:
                $tinTucDetail = NewsMapper::mapNewsDetailDtoFromEntity($news);
                break;
            default:
                break;
        }
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Truy vấn thành công.'
                , [
                    camelToSnakeUpper(class_basename(News::class)) => $tinTucDetail
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function getDetailBasicTinTuc($id) {
        return $this->newsRepository->getDetailBasicTinTuc($id);
    }

    public function deleteTinTuc($id, Request $request) {
        DB::beginTransaction();
        $news = self::getOrNewTinTuc($id);
        $news->STATUS = AppConstant::STATUS_DELETED;
        $news->save();
        DB::commit();
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Xóa thành công.'
                , [
                    camelToSnakeUpper(class_basename(News::class)) => null
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function getListTinTuc(Request $request) {
        $draw = $request->input('DRAW', 1);
        $page = $request->query('PAGE', 1);
        $perPage = $request->query('PER_PAGE', 10);
        $isGetAllElements = filter_var($request->query('IS_GET_ALL_ELEMENTS', false), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        if ($isGetAllElements === true) {
            $perPage = 2147483647;
        }
        $tuKhoa = $request->input('TU_KHOA', null);
        $trangThaiHoatDong = $request->input('TRANG_THAI_HOAT_DONG', null);
        $arrDanhMucTinTucId = $request->input('DANH_MUC_TIN_TUC_ID', Array());
        $boLoc = $request->input('BO_LOC', null);
        $arrNotInId = $request->query('NOT_IN_ID');
        $newsHot = $request->input('LOAI_TIN_TUC', null);
        $isApiPublic = filter_var($request->input('IS_API_PUBLIC', false), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        $resultPagination = $this->newsRepository->getListTinTuc($tuKhoa, $arrDanhMucTinTucId, $trangThaiHoatDong
            , $boLoc
            , $arrNotInId
            , $newsHot
            , $request
            , $isApiPublic
            , $page, $perPage);

        $listNewsDto = NewsMapper::mapListNewsDetailFromPaginator($resultPagination->getCollection());
        $resultPagination->setCollection($listNewsDto);
        $customResponsePagination = PaginationUtils::pagination($resultPagination);
        $customResponsePagination['DRAW'] = $draw;
        
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Truy vấn thành công.'
                , [
                    camelToSnakeUpper(class_basename(News::class)) => $customResponsePagination
                ]
                , JsonResponse::HTTP_OK
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function activeTinTuc($id, Request $request) {
        DB::beginTransaction();
        $news = $this->newsRepository->getDetailTinTuc($id);
        $news->IS_ACTIVE = filter_var($request->input('IS_ACTIVE') ?? true, FILTER_VALIDATE_BOOLEAN);
        $news->save();
        DB::commit();
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Chuyển đổi trạng thái thành công.'
                , [
                    class_basename(News::class) => null
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }
} 