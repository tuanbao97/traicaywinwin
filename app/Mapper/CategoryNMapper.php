<?php

namespace App\Mapper;

use App\Dto\categoryN\CategoryNDetailDto;
use App\Dto\documentStorage\DocumentStorageDetailDto;
use App\Models\CategoryN;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CategoryNMapper
{
    public static function mapFromArray(CategoryN $categoryN, array $data) : ?CategoryN {
        if ($categoryN == null) return null;

        $categoryN->ID = self::issetkey($data, 'ID');
        $categoryN->PARENT_ID = self::issetkey($data, 'PARENT_ID');
        $categoryN->NAME = self::issetkey($data, 'TEN_DANH_MUC_TIN_TUC');
        $categoryN->SORT_ORDER = self::issetkey($data, 'SORT_ORDER', 0);
        $categoryN->DESCRIPTION = self::issetkey($data, 'MO_TA');
        $categoryN->TREE_LEVEL = self::issetkey($data, 'TREE_LEVEL', 1);
        $categoryN->IS_ACTIVE = filter_var(self::issetkey($data, 'TRANG_THAI_HOAT_DONG', true), FILTER_VALIDATE_BOOLEAN);
        $categoryN->ATTR50 = self::issetkey($data, 'PATH_VIEW');

        $categoryN->CRT_DT = !is_null($categoryN->CRT_DT) ? $categoryN->CRT_DT : Carbon::now();
        $categoryN->UPD_DT = Carbon::now();
        $categoryN->CRT_ID = !is_null($categoryN->CRT_ID) ? $categoryN->CRT_ID : Auth::user()->ID;
        $categoryN->UPD_ID = Auth::user()->ID;
        $categoryN->CRT_NAME = !is_null($categoryN->CRT_NAME) ? $categoryN->CRT_NAME : Auth::user()->FULL_NAME;
        $categoryN->UPD_NAME = Auth::user()->FULL_NAME;
        
        return $categoryN;
    }

    public static function mapCategoryNDetailFromEntity(CategoryN $categoryN, bool $isRetrieveChildren = false): ?CategoryNDetailDto {
        if ($categoryN == null) return null;

        $categoryNDetail = CategoryNDetailDto::createEmpty();

        $categoryNDetail->id = $categoryN->ID;
        // Avatar hình đại diện
        if (isset($categoryN->avatars) && count($categoryN->avatars) > 0) {
            foreach ($categoryN->avatars as $index => $avatar) {
                $avatarUpload = DocumentStorageDetailDto::createEmpty();
                $avatarUpload->id = $avatar->ID;
                $avatarUpload->name = $avatar->NAME;
                $avatarUpload->originalName = $avatar->ORIGINAL_NAME;
                $avatarUpload->extension = $avatar->EXTENSION;
                $avatarUpload->path = $avatar->PATH;
                $avatarUpload->directory = $avatar->DIRECTORY;
                $avatarUpload->size = $avatar->SIZE;
                $avatarUpload->md5 = $avatar->MD5;
                $avatarUpload->typeFile = $avatar->TYPE_FILE;
                $avatarUpload->description = $avatar->DESCRIPTION;

                // Pivot
                $avatarUpload->sortOrder = $avatar->pivot->SORT_ORDER;
                $avatarUpload->type = $avatar->pivot->ATTR1;
                $avatarUpload->aspectRatio = $avatar->pivot->ATTR2;
                $avatarUpload->isThumnail = $avatar->pivot->IS_THUMNAIL;

                $avatarUpload->crtId = $avatar->CRT_ID;
                $avatarUpload->crtDt = $avatar->CRT_DT;
                $avatarUpload->updId = $avatar->UPD_ID;
                $avatarUpload->updDt = $avatar->UPD_DT;
                $avatarUpload->crtName = $avatar->CRT_NAME;
                $avatarUpload->updName = $avatar->UPD_NAME;

                // Thêm vào danh sách mảng
                $categoryNDetail->danhSachHinhAnhDaiDien[] = $avatarUpload;
            }
        }

        // Thông tin danh mục sản phẩm
        $categoryNDetail->name = $categoryN->NAME;
        $categoryNDetail->nameSlug = convertStrToSlug($categoryN->NAME);
        $categoryNDetail->parentId = $categoryN->PARENT_ID;
        $categoryNDetail->sortOrder = $categoryN->SORT_ORDER;
        $categoryNDetail->description = $categoryN->DESCRIPTION;
        $categoryNDetail->treeLevel = $categoryN->TREE_LEVEL;
        $categoryNDetail->countChildren = empty($categoryN->COUNT_CHILDREN) ? 0 : $categoryN->COUNT_CHILDREN;

        $categoryNDetail->pathView = $categoryN->ATTR50;
        
        // CategoryN childrens
        if ($isRetrieveChildren == true) {
            if (isset($categoryN->childrens) && count($categoryN->childrens) > 0) {
                foreach ($categoryN->childrens as $index => $categoryNChild) {
                    $categoryNDetail->danhSachChildren[] = self::mapCategoryNDetailFromEntity($categoryNChild, true);
                }
                $categoryNDetail->countChildren = count($categoryN->childrens);
            }
        }
        

        // Thông tin modire và trạng thái hoạt động
        $categoryNDetail->crtId = $categoryN->CRT_ID;
        $categoryNDetail->crtDt = $categoryN->CRT_DT;
        $categoryNDetail->updId = $categoryN->UPD_ID;
        $categoryNDetail->updDt = $categoryN->UPD_DT;
        $categoryNDetail->status = $categoryN->STATUS;
        $categoryNDetail->crtName = $categoryN->CRT_NAME;
        $categoryNDetail->updName = $categoryN->UPD_NAME;
        if (!is_null($categoryN->IS_ACTIVE)) $categoryNDetail->isActive = filter_var($categoryN->IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);

        return $categoryNDetail;
    }
    
    /**
     * @param Collection<CategoryN> $listCategoryN
     * @return Collection<CategoryNDetailDto>
     */
    public static function mapListCategoryNDetailFromPaginator(Collection $listCategoryN, bool $isRetrieveChildren = false): Collection {
        $listCategoryNDto = new Collection();
        if (empty($listCategoryN)) return $listCategoryNDto;
        
        foreach ($listCategoryN as $key => $categoryN) {
            $listCategoryNDto->push(self::mapCategoryNDetailFromEntity($categoryN, $isRetrieveChildren));
        }
        return $listCategoryNDto;
    }
        
    private static function issetkey($array, $fieldName, $defaultValue = null) {
        return isset($array[$fieldName]) ? $array[$fieldName] : $defaultValue;
    }

}
