<?php

namespace App\Repository\impl;

use App\Dto\sort\SortRequestDto;
use App\Enum\AppConstant;
use App\Models\Video;
use App\Repository\BaseRepository;
use App\Repository\VideoRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class VideoRepositoryImpl extends BaseRepository implements VideoRepository
{
    public function getModel()
    {
        return Video::class;
    }

    public function getDetailVideo(int $id) : ?Video {
        return Video::query()
        ->where([
            ['ID', '=', $id]
            , ['STATUS', '=', AppConstant::STATUS_USING]
        ])->first();
    }

    public function getDetailVideoWithFetchEdger(int $id) : ?Video {
        return Video::query()
        ->with(['images', 'files']) // Eager load relationships
        ->where([
            ['ID', '=', $id]
            , ['STATUS', '=', AppConstant::STATUS_USING]
        ])->first();
    }

    public function getListVideo(
        ?string $tuKhoa, ?bool $trangThaiHoatDong,
        ?string $boLoc, ?array $arrNotInId, ?bool $videoHot, Request $request,
        ?bool $isApiPublic, int $page, int $perPage
    ) : LengthAwarePaginator {
        $query = DB::table('video AS v')
            ->leftJoin('video_document_storage as vds_avatar', function ($join) {
                $join->on('v.ID', '=', 'vds_avatar.VIDEO_ID')
                    ->where('vds_avatar.ATTR1', '=', 'DANH_SACH_HINH_ANH_DAI_DIEN')
                    ->where('vds_avatar.IS_THUMNAIL', true)
                    ->where('vds_avatar.STATUS', '=', AppConstant::STATUS_USING);
            })
            ->leftJoin('document_storage as ds_avatar', function ($join) {
                $join->on('ds_avatar.ID', '=', 'vds_avatar.DOCUMENT_STORAGE_ID');
            })
            ->where([
                ['v.STATUS', '=', AppConstant::STATUS_USING]
            ])
            ->select(
                'v.*',
                'ds_avatar.ID as OBJ_AVATAR_ID',
                'ds_avatar.NAME as OBJ_AVATAR_NAME',
                'ds_avatar.ORIGINAL_NAME as OBJ_AVATAR_ORIGINAL_NAME',
                'ds_avatar.EXTENSION as OBJ_AVATAR_EXTENSION',
                'ds_avatar.PATH as OBJ_AVATAR_PATH',
                'ds_avatar.DIRECTORY as OBJ_AVATAR_DIRECTORY',
                'ds_avatar.SIZE as OBJ_AVATAR_SIZE',
                'ds_avatar.MD5 as OBJ_AVATAR_MD5',
                'ds_avatar.TYPE_FILE as OBJ_AVATAR_TYPE_FILE',
                'ds_avatar.DESCRIPTION as OBJ_AVATAR_DESCRIPTION',
                'ds_avatar.CRT_ID as OBJ_AVATAR_CRT_ID',
                'ds_avatar.CRT_NAME as OBJ_AVATAR_CRT_NAME',
                'ds_avatar.CRT_DT as OBJ_AVATAR_CRT_DT',
                'ds_avatar.UPD_ID as OBJ_AVATAR_UPD_ID',
                'ds_avatar.UPD_NAME as OBJ_AVATAR_UPD_NAME',
                'ds_avatar.UPD_DT as OBJ_AVATAR_UPD_DT',
                'ds_avatar.IS_ACTIVE as OBJ_AVATAR_IS_ACTIVE',
                'vds_avatar.SORT_ORDER as OBJ_AVATAR_SORT_ORDER',
                'vds_avatar.ATTR1 as OBJ_AVATAR_TYPE',
                'vds_avatar.IS_THUMNAIL as OBJ_AVATAR_IS_THUMNAIL',
                'vds_avatar.ATTR2 as OBJ_AVATAR_ASPECT_RATIO'
            );

        // Filter theo từ khóa
        if (!empty($tuKhoa)) {
            $query->where(function ($q) use ($tuKhoa) {
                $q->where('v.TITLE', 'LIKE', '%' . $tuKhoa . '%')
                  ->orWhere('v.SUMMARY', 'LIKE', '%' . $tuKhoa . '%')
                  ->orWhere('v.CONTENT_FORMAT', 'LIKE', '%' . $tuKhoa . '%');
            });
        }

        // Filter theo trạng thái hoạt động
        if (!is_null($trangThaiHoatDong) && $trangThaiHoatDong !== 'all') {
            $query->where('v.IS_ACTIVE', $trangThaiHoatDong);
        }

        // Filter theo video hot
        if (!is_null($videoHot)) {
            $query->where('v.IS_HOT_VIDEO', $videoHot);
        }

        // Filter loại bỏ các ID không lấy
        if (!empty($arrNotInId) && is_array($arrNotInId)) {
            $query->whereNotIn('v.ID', $arrNotInId);
        }

        // Filter cho API public: chỉ lấy video đang active
        if ($isApiPublic === true) {
            $query->where('v.IS_ACTIVE', true);
        }

        // Sắp xếp
        $sortDto = SortRequestDto::fromRequest($request);
        if (!blank($boLoc)) {
            switch ($boLoc) {
                case 'default':
                    $query->orderBy('v.CRT_DT', 'desc');
                    break;
                case 'a-z':
                    $query->orderBy('v.TITLE', 'asc');
                    break;
                case 'z-a':
                    $query->orderBy('v.TITLE', 'desc');
                    break;
                case 'cu-den-moi':
                    $query->orderBy('v.UPD_DT', 'asc');
                    break;
                case 'moi-den-cu':
                    $query->orderBy('v.UPD_DT', 'desc');
                    break;
                default:
                    $query->orderBy('v.CRT_DT', 'desc');
                    break;
            }
        } else if (!is_null($sortDto) && !is_null($sortDto->fieldName)) {
            $fieldName = $sortDto->fieldName;
            $sortType = $sortDto->sortType;

            switch ($fieldName) {
                case 'STT':
                    $query->orderBy('v.CRT_DT', strtolower($sortType) == 'desc' ? 'asc' : 'desc');
                    break;
                case 'TIEU_DE_VIDEO':
                    $query->orderBy('v.TITLE', strtolower($sortType));
                    break;
                case 'TOM_TAT_VIDEO':
                    $query->orderBy('v.SUMMARY', strtolower($sortType));
                    break;
                case 'LOAI_VIDEO': 
                case 'VIDEO_NOI_BAT':
                    $query->orderBy('v.IS_HOT_VIDEO', strtolower($sortType));
                    break;
                default:
                    $query->orderBy('v.CRT_DT', 'desc');
                    break;
            } 
        } else {
            // Sắp xếp mặc định: ưu tiên video hot trước, sau đó theo thời gian tạo mới nhất
            if ($isApiPublic === true) {
                $query->orderByRaw('CASE WHEN v.IS_HOT_VIDEO = ? THEN 0 ELSE 1 END', [true])
                      ->orderBy('v.CRT_DT', 'desc');
            } else {
                $query->orderBy('v.CRT_DT', 'desc');
            }
        }

        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}
