<?php

namespace App\Mapper;

use App\Dto\categoryP\CategoryPDetailDto;
use App\Dto\documentStorage\DocumentStorageDetailDto;
use App\Models\CategoryP;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\List_;

class CategoryPMapper
{
    public static function mapFromArray(CategoryP $categoryP, array $data) : ?CategoryP {
        if ($categoryP == null) return null;

        $categoryP->ID = self::issetkey($data, 'ID');
        $categoryP->PARENT_ID = self::issetkey($data, 'PARENT_ID');
        $categoryP->NAME = self::issetkey($data, 'TEN_DANH_MUC_SAN_PHAM');
        $categoryP->SORT_ORDER = self::issetkey($data, 'SORT_ORDER', 0);
        $categoryP->DESCRIPTION = self::issetkey($data, 'MO_TA');
        $categoryP->TREE_LEVEL = self::issetkey($data, 'TREE_LEVEL', 1);
        $categoryP->IS_ACTIVE = filter_var(self::issetkey($data, 'TRANG_THAI_HOAT_DONG', true), FILTER_VALIDATE_BOOLEAN);
        $categoryP->ATTR50 = self::issetkey($data, 'PATH_VIEW');

        $categoryP->CRT_DT = !is_null($categoryP->CRT_DT) ? $categoryP->CRT_DT : Carbon::now();
        $categoryP->UPD_DT = Carbon::now();
        $categoryP->CRT_ID = !is_null($categoryP->CRT_ID) ? $categoryP->CRT_ID : Auth::user()->ID;
        $categoryP->UPD_ID = Auth::user()->ID;
        $categoryP->CRT_NAME = !is_null($categoryP->CRT_NAME) ? $categoryP->CRT_NAME : Auth::user()->FULL_NAME;
        $categoryP->UPD_NAME = Auth::user()->FULL_NAME;
        
        return $categoryP;
    }

    public static function mapCategoryPDetailFromEntity(CategoryP $categoryP, bool $isRetrieveChildren = false): ?CategoryPDetailDto {
        if ($categoryP == null) return null;

        $categoryPDetail = CategoryPDetailDto::createEmpty();

        $categoryPDetail->id = $categoryP->ID;
        // Avatar hình đại diện
        if (isset($categoryP->avatars) && count($categoryP->avatars) > 0) {
            foreach ($categoryP->avatars as $index => $avatar) {
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
                $categoryPDetail->danhSachHinhAnhDaiDien[] = $avatarUpload;
            }
        }

        // Thông tin danh mục sản phẩm
        $categoryPDetail->name = $categoryP->NAME;
        $categoryPDetail->nameSlug = convertStrToSlug($categoryP->NAME);
        $categoryPDetail->parentId = $categoryP->PARENT_ID;
        $categoryPDetail->sortOrder = $categoryP->SORT_ORDER;
        $categoryPDetail->description = $categoryP->DESCRIPTION;
        $categoryPDetail->treeLevel = $categoryP->TREE_LEVEL;
        $categoryPDetail->countChildren = empty($categoryP->COUNT_CHILDREN) ? 0 : $categoryP->COUNT_CHILDREN;

        $categoryPDetail->pathView = $categoryP->ATTR50;
        
        // CategoryP childrens
        if ($isRetrieveChildren == true) {
            if (isset($categoryP->childrens) && count($categoryP->childrens) > 0) {
                foreach ($categoryP->childrens as $index => $categoryPChild) {
                    $categoryPDetail->danhSachChildren[] = self::mapCategoryPDetailFromEntity($categoryPChild, true);
                }
                $categoryPDetail->countChildren = count($categoryP->childrens);
            }
        }
        

        // Thông tin modire và trạng thái hoạt động
        $categoryPDetail->crtId = $categoryP->CRT_ID;
        $categoryPDetail->crtDt = $categoryP->CRT_DT;
        $categoryPDetail->updId = $categoryP->UPD_ID;
        $categoryPDetail->updDt = $categoryP->UPD_DT;
        $categoryPDetail->status = $categoryP->STATUS;
        $categoryPDetail->crtName = $categoryP->CRT_NAME;
        $categoryPDetail->updName = $categoryP->UPD_NAME;
        if (!is_null($categoryP->IS_ACTIVE)) $categoryPDetail->isActive = filter_var($categoryP->IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);

        return $categoryPDetail;
    }
    
    /**
     * @param Collection<CategoryP> $listCategoryP
     * @return Collection<CategoryPDetailDto>
     */
    public static function mapListCategoryPDetailFromPaginator(Collection $listCategoryP, bool $isRetrieveChildren = false): Collection {
        $listCategoryPDto = new Collection();
        if (empty($listCategoryP)) return $listCategoryPDto;
        
        foreach ($listCategoryP as $key => $categoryP) {
            $listCategoryPDto->push(self::mapCategoryPDetailFromEntity($categoryP, $isRetrieveChildren));
        }
        return $listCategoryPDto;
    }
        
    private static function issetkey($array, $fieldName, $defaultValue = null) {
        return isset($array[$fieldName]) ? $array[$fieldName] : $defaultValue;
    }

}
