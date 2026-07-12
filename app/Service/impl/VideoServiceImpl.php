<?php

namespace App\Service\impl;

use App\Dto\video\VideoDetailDto;
use App\Dto\response\ApiResponseDto;
use App\Enum\AppConstant;
use App\Mapper\VideoMapper;
use App\Models\Video;
use App\Repository\VideoRepository;
use App\Repository\VideoDocumentStorageRepository;
use App\Service\VideoService;
use App\Utils\PaginationUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoServiceImpl implements VideoService
{
    // Inject beans
    private VideoRepository $videoRepository;
    private VideoDocumentStorageRepository $videoDocumentStorageRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(VideoRepository $videoRepository, VideoDocumentStorageRepository $videoDocumentStorageRepository)
    {
        $this->videoRepository = $videoRepository;
        $this->videoDocumentStorageRepository = $videoDocumentStorageRepository;
    }

    public function getOrNewVideo($id): Video
    {
        $video = ($id != null) ? $this->videoRepository->getDetailVideo($id) : new Video();
        return $video;
    }

    public function handleSaveFileDinhKem($videoId, array $documentStorages)
    {
        if (isset($documentStorages) && count($documentStorages) > 0) {
            $this->videoDocumentStorageRepository->saveVideoDocumentStorages($videoId, $documentStorages);
        }
    }

    public function deleteAllVideoFileDinhKems($videoId): bool
    {
        return $this->videoDocumentStorageRepository->deleteAllVideoFileDinhKems($videoId);
    }

    public function saveVideo(Request $request)
    {
        $id = $request->input('ID', null);
        DB::beginTransaction();
        $data = $request->all();
        $video = self::getOrNewVideo($id);
        VideoMapper::mapFromArray($video, $data);
        $arrVideo = $video->toArray();
        $video = $this->videoRepository->save($arrVideo);
        $video = is_null($id) ? $video : $video->first();
        
        // Xử lý file uploads - delete tất cả file cũ trước
        self::deleteAllVideoFileDinhKems($video->ID);
        
        // Hình ảnh đại diện
        $danhSachHinhAnhDaiDienUpload = $request->input('DANH_SACH_HINH_ANH_DAI_DIEN', null);
        if (!is_null($danhSachHinhAnhDaiDienUpload) && count($danhSachHinhAnhDaiDienUpload) > 0) {
            self::handleSaveFileDinhKem($video->ID, $danhSachHinhAnhDaiDienUpload);
        }
        
        // File đính kèm
        $danhSachFileDinhKemUpload = $request->input('DANH_SACH_FILE_DINH_KEM', null);
        if (!is_null($danhSachFileDinhKemUpload) && count($danhSachFileDinhKemUpload) > 0) {
            self::handleSaveFileDinhKem($video->ID, $danhSachFileDinhKemUpload);
        }
        
        DB::commit();
        return response()->json(
            new ApiResponseDto(
                AppConstant::STATUS_SUCCESS,
                is_null($id) ? 'Tạo mới thành công.' : 'Cập nhật thành công.',
                [
                    camelToSnakeUpper(class_basename(Video::class))
                        => new VideoDetailDto($video->ID, $video->TITLE, convertStrToSlug($video->TITLE))
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function getDetailVideo($id, Request $request) {
        $video = $this->videoRepository->getDetailVideoWithFetchEdger($id);
        $videoDetail = null;
        if (!is_null($video)) {
            $videoDetail = VideoMapper::mapVideoDetailDtoFromEntity($video);
        }
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Truy vấn thành công.'
                , [
                    camelToSnakeUpper(class_basename(Video::class)) => $videoDetail
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function deleteVideo($id, Request $request) {
        DB::beginTransaction();
        $video = self::getOrNewVideo($id);
        $video->STATUS = AppConstant::STATUS_DELETED;
        $video->save();
        DB::commit();
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Xóa thành công.'
                , [
                    camelToSnakeUpper(class_basename(Video::class)) => null
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function getListVideo(Request $request) {
        $draw = $request->input('DRAW', 1);
        $page = $request->query('PAGE', 1);
        $perPage = $request->query('PER_PAGE', 10);
        $isGetAllElements = filter_var($request->query('IS_GET_ALL_ELEMENTS', false), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        if ($isGetAllElements === true) {
            $perPage = 2147483647;
        }
        $tuKhoa = $request->input('TU_KHOA', null);
        $trangThaiHoatDong = $request->input('TRANG_THAI_HOAT_DONG', null);
        $boLoc = $request->input('BO_LOC', null);
        $arrNotInId = $request->input('NOT_IN_ID');
        $videoHot = $request->input('LOAI_VIDEO', null);
        $isApiPublic = filter_var($request->input('IS_API_PUBLIC', false), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        $resultPagination = $this->videoRepository->getListVideo($tuKhoa, $trangThaiHoatDong
            , $boLoc
            , $arrNotInId
            , $videoHot
            , $request
            , $isApiPublic
            , $page, $perPage);

        $listVideoDto = VideoMapper::mapListVideoDetailFromPaginator($resultPagination->getCollection());
        $resultPagination->setCollection($listVideoDto);
        $customResponsePagination = PaginationUtils::pagination($resultPagination);
        $customResponsePagination['DRAW'] = $draw;
        
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Truy vấn thành công.'
                , [
                    camelToSnakeUpper(class_basename(Video::class)) => $customResponsePagination
                ]
                , JsonResponse::HTTP_OK
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function activeVideo($id, Request $request) {
        DB::beginTransaction();
        $video = $this->videoRepository->getDetailVideo($id);
        $video->IS_ACTIVE = filter_var($request->input('IS_ACTIVE') ?? true, FILTER_VALIDATE_BOOLEAN);
        $video->save();
        DB::commit();
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Chuyển đổi trạng thái thành công.'
                , [
                    class_basename(Video::class) => null
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }
}
