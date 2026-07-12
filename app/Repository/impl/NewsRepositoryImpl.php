<?php

namespace App\Repository\impl;

use App\Dto\sort\SortRequestDto;
use App\Enum\AppConstant;
use App\Models\CategoryN;
use App\Models\News;
use App\Repository\BaseRepository;
use App\Repository\NewsRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class NewsRepositoryImpl extends BaseRepository implements NewsRepository
{
    public function getModel()
    {
        return News::class;
    }

    public function getDetailTinTuc(int $id) : ?News {
        return News::query()
        ->where([
            ['ID', '=', $id]
            , ['STATUS', '=', AppConstant::STATUS_USING]
        ])->first();
    }

    public function getDetailBasicTinTuc(int $id) : ?News {
        $query = News::query()
                ->from('news AS n')
                ->join('news_category AS nc', function ($join) {
                    $join->on('n.id', '=', 'nc.news_id')
                        ->where('nc.STATUS', '=', AppConstant::STATUS_USING);
                })
                ->where([
                    ['n.STATUS', '=', AppConstant::STATUS_USING]
                    , ['n.ID', '=', $id]
                ])
                ->select(
                    'n.*',
                    'nc.CATEGORY_ID as CATEGORY_ID'
                );
        return $query->first();
    }

    public function getDetailTinTucWithFetchEdger(int $id) : ?News {
        return News::query()
        ->with(['avatars', 'images', 'videos', 'files', 'categories', 'user', 'approvedUser']) // Đây là fetch EAGER
        ->where([
            ['ID', '=', $id]
            , ['STATUS', '=', AppConstant::STATUS_USING]
        ])->first();
    }

    public function getListTinTuc(
        ?string $tuKhoa, ?array $arrDanhMucTinTucId, ?bool $trangThaiHoatDong,
        ?string $boLoc, ?array $arrNotInId, ?bool $newsHot, Request $request,
        ?bool $isApiPublic, int $page, int $perPage
    ) : LengthAwarePaginator {
        $query = DB::table('news AS n')
            ->join('news_category AS nc', function ($join) {
                $join->on('n.id', '=', 'nc.news_id')
                    ->where('nc.STATUS', '=', AppConstant::STATUS_USING);
            })
            ->join('category_n AS cn', function ($join) {
                $join->on('cn.id', '=', 'nc.category_id')
                    ->where('cn.STATUS', '=', AppConstant::STATUS_USING);
            })
            ->leftJoin('news_document_storage as nds_avatar', function ($join) {
                $join->on('n.id', '=', 'nds_avatar.news_id')
                    ->where('nds_avatar.attr1', '=', 'DANH_SACH_HINH_ANH_DAI_DIEN')
                    ->where('nds_avatar.IS_THUMNAIL', true)
                    ->where('nds_avatar.STATUS', '=', AppConstant::STATUS_USING);
            })
            ->leftJoin('document_storage as ds_avatar', function ($join) {
                $join->on('ds_avatar.ID', '=', 'nds_avatar.DOCUMENT_STORAGE_ID');
            })
            ->leftJoin('user as u', function ($join) {
                $join->on('u.ID', '=', 'n.USER_POST_NEWS_ID')
                    ->where('u.STATUS', '=', AppConstant::STATUS_USING);
            })
            ->where([
                ['n.STATUS', '=', AppConstant::STATUS_USING]
            ])
            ->distinct()
            ->select(
                'n.*',
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
                'nds_avatar.IS_THUMNAIL as OBJ_AVATAR_IS_THUMNAIL',
                'nds_avatar.SORT_ORDER as OBJ_AVATAR_SORT_ORDER',
                'nds_avatar.ATTR1 as OBJ_AVATAR_TYPE',
                'nds_avatar.ATTR2 as OBJ_AVATAR_ASPECT_RATIO',
                'cn.ID as OBJ_CATEGORY_ID',
                'cn.NAME as OBJ_CATEGORY_NAME',
                'cn.PARENT_ID as OBJ_CATEGORY_PARENT_ID',
                'cn.SORT_ORDER as OBJ_CATEGORY_SORT_ORDER',
                'cn.DESCRIPTION as OBJ_CATEGORY_DESCRIPTION',
                'cn.TREE_LEVEL as OBJ_CATEGORY_TREE_LEVEL',
                'cn.CRT_ID as OBJ_CATEGORY_CRT_ID',
                'cn.CRT_NAME as OBJ_CATEGORY_CRT_NAME',
                'cn.CRT_DT as OBJ_CATEGORY_CRT_DT',
                'cn.UPD_ID as OBJ_CATEGORY_UPD_ID',
                'cn.UPD_NAME as OBJ_CATEGORY_UPD_NAME',
                'cn.UPD_DT as OBJ_CATEGORY_UPD_DT',
                'cn.IS_ACTIVE as OBJ_CATEGORY_IS_ACTIVE',
                'u.ID as OBJ_USER_ID',
                'u.FULL_NAME as OBJ_USER_FULL_NAME',
                'u.EMAIL as OBJ_USER_EMAIL',
                'u.IS_ACTIVE as OBJ_USER_IS_ACTIVE',
                'u.STATUS as OBJ_USER_STATUS',
                'u.CRT_ID as OBJ_USER_CRT_ID',
                'u.CRT_NAME as OBJ_USER_CRT_NAME',
                'u.CRT_DT as OBJ_USER_CRT_DT',
                'u.UPD_ID as OBJ_USER_UPD_ID',
                'u.UPD_NAME as OBJ_USER_UPD_NAME',
                'u.UPD_DT as OBJ_USER_UPD_DT'
            );

        // Filter theo từ khóa
        if (!empty($tuKhoa)) {
            $query->where(function ($q) use ($tuKhoa) {
                $q->where('n.TITLE', 'LIKE', '%' . $tuKhoa . '%')
                  ->orWhere('n.SUMMARY', 'LIKE', '%' . $tuKhoa . '%')
                  ->orWhere('n.CONTENT_FORMAT', 'LIKE', '%' . $tuKhoa . '%');
            });
        }

        // Filter theo danh mục tin tức
        if (!is_null($arrDanhMucTinTucId) && is_array($arrDanhMucTinTucId) && count($arrDanhMucTinTucId) > 0) {
            // Lấy toàn bộ ID danh mục con
            $allCategoryIds = $arrDanhMucTinTucId;
            $childIds = CategoryN::getAllChildCategoryIds($arrDanhMucTinTucId, [], $isApiPublic);
            $allCategoryIds = array_merge($allCategoryIds, $childIds);

            $query->whereIn('cn.ID', $allCategoryIds);
        }

        // Filter theo trạng thái hoạt động
        if (!is_null($trangThaiHoatDong) && $trangThaiHoatDong !== 'all') {
            $query->where('n.IS_ACTIVE', $trangThaiHoatDong);
        }

        // Filter theo tin hot
        if (!is_null($newsHot)) {
            $query->where('n.IS_HOT_NEWS', $newsHot);
        }

        // Filter loại bỏ các ID không lấy
        if (!empty($arrNotInId) && is_array($arrNotInId)) {
            $query->whereNotIn('n.ID', $arrNotInId);
        }

        // Filter cho API public: chỉ lấy tin đang active
        if ($isApiPublic === true) {
            $query->where([
                ['n.IS_ACTIVE', true],
                ['cn.IS_ACTIVE', true]
            ]);
        }

        // Sắp xếp
        $sortDto = SortRequestDto::fromRequest($request);
        if (!blank($boLoc)) {
            switch ($boLoc) {
                case 'default':
                    # code...
                    break;
                case 'a-z':
                    $query->orderBy('n.TITLE', 'asc');
                    break;
                case 'z-a':
                    $query->orderBy('n.TITLE', 'desc');
                    break;
                case 'cu-den-moi':
                    $query->orderBy('n.UPD_DT', 'asc');
                    break;
                case 'moi-den-cu':
                    $query->orderBy('n.UPD_DT', 'desc');
                    break;
                default:
                    # code...
                    break;
            }
        } else if (!is_null($sortDto) && !is_null($sortDto->fieldName)) {
            $fieldName = $sortDto->fieldName;
            $sortType = $sortDto->sortType;

            switch ($fieldName) {
                case 'STT':
                    $query->orderBy('n.CRT_DT', strtolower($sortType) == 'desc' ? 'asc' : 'desc');
                    break;
                case 'TIEU_DE_TIN_TUC':
                    $query->orderBy('n.TITLE', strtolower($sortType));
                    break;
                case 'DANH_MUC_TIN_TUC':
                    $query->orderBy('cn.NAME', strtolower($sortType));
                    break;
                case 'TOM_TAT_TIN_TUC':
                    $query->orderBy('m.TOM_TAT_TIN_TUC', strtolower($sortType));
                    break;
                case 'LOAI_TIN_TUC': 
                    $query->orderBy('n.IS_HOT_NEWS', strtolower($sortType));
                    break;
                default:
                    # code...
                    break;
            } 
        } else {
            $query->orderBy('n.CRT_DT', 'desc');
        }

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    public function deleteAllTinTucFileDinhKems($newsId) : bool {
        return DB::table('news_document_storage')
            ->where('NEWS_ID', $newsId)
            ->update(['STATUS' => AppConstant::STATUS_DELETED]);
    }

    public function saveNewsDocumentStorages($newsId, array $documentStorages)
    {
        foreach ($documentStorages as $documentStorage) {
            $documentStorage['NEWS_ID'] = $newsId;
            $documentStorage['CRT_DT'] = now();
            $documentStorage['UPD_DT'] = now();
            $documentStorage['STATUS'] = AppConstant::STATUS_USING;
            $documentStorage['IS_ACTIVE'] = true;

            DB::table('news_document_storage')->insert($documentStorage);
        }
    }

    public function deleteAllTinTucDanhMucTinTuc($newsId) : bool
    {
        return DB::table('news_category')
            ->where('NEWS_ID', $newsId)
            ->update(['STATUS' => AppConstant::STATUS_DELETED]);
    }

    public function saveNewsCategories($newsId, array $categories)
    {
        foreach ($categories as $category) {
            $category['NEWS_ID'] = $newsId;
            $category['CRT_DT'] = now();
            $category['UPD_DT'] = now();
            $category['STATUS'] = AppConstant::STATUS_USING;
            $category['IS_ACTIVE'] = true;

            DB::table('news_category')->insert($category);
        }
    }
} 