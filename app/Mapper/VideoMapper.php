<?php

namespace App\Mapper;

use App\Dto\video\VideoDetailDto;
use App\Dto\documentStorage\DocumentStorageDetailDto;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class VideoMapper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function mapFromArray(Video $video, array $data) : ?Video {
        if ($video == null) return null;
        
        $video->ID = self::issetkey($data, 'ID');
        $video->TITLE = self::issetkey($data, 'TIEU_DE_VIDEO');
        $video->SUMMARY = self::issetkey($data, 'TOM_TAT_VIDEO');
        $video->CONTENT_FORMAT = self::issetkey($data, 'NOI_DUNG_VIDEO');
        $video->CONTENT_RAW = self::issetkey($data, 'NOI_DUNG_VIDEO_ONLY_TEXT');
        $video->META_SEO_KEYWORDS = self::issetkey($data, 'META_SEO_KEYWORDS');
        $video->META_SEO_DESCRIPTION = self::issetkey($data, 'META_SEO_DESCRIPTION');
        $video->IS_HOT_VIDEO = filter_var(self::issetkey($data, 'VIDEO_NOI_BAT', false), FILTER_VALIDATE_BOOLEAN);
        $video->IS_ACTIVE = filter_var(self::issetkey($data, 'TRANG_THAI_HOAT_DONG', true), FILTER_VALIDATE_BOOLEAN);
        $video->COUNT_VIEWS = self::issetkey($data, 'SO_LUOT_XEM', 0);

        // Lấy thông tin người dùng từ Auth Guard
        $user = Auth::user();
        
        if ($user) {
            if (is_null($video->ID)) { // Trường hợp tạo mới
                $video->CRT_ID = $user->ID;
                $video->CRT_NAME = $user->FULL_NAME;
                $video->CRT_DT = Carbon::now();
            }
    
            $video->UPD_ID = $user->ID;
            $video->UPD_NAME = $user->FULL_NAME;
            $video->UPD_DT = Carbon::now();
        }

        return $video;
    }
    
    public static function mapVideoDetailDtoFromEntity($video): ?VideoDetailDto {
        if ($video == null) return null;

        $videoDto = VideoDetailDto::createEmpty();

        $videoDto->id = $video->ID;
        $videoDto->title = $video->TITLE;
        $videoDto->titleSlug = convertStrToSlug($video->TITLE);
        $videoDto->summary = $video->SUMMARY;
        $videoDto->contentFormat = convertMediaPathsToAbsolute($video->CONTENT_FORMAT);
        $videoDto->contentRaw = $video->CONTENT_RAW;
        $videoDto->contentOnlyText = strip_tags($video->CONTENT_FORMAT);
        $videoDto->metaSeoKeywords = $video->META_SEO_KEYWORDS;
        $videoDto->metaSeoDescription = $video->META_SEO_DESCRIPTION;
        $videoDto->isHotVideo = $video->IS_HOT_VIDEO;
        $videoDto->countViews = $video->COUNT_VIEWS;
        $videoDto->isActive = $video->IS_ACTIVE;
        $videoDto->status = $video->STATUS;
        $videoDto->crtDt = $video->CRT_DT;
        $videoDto->crtId = $video->CRT_ID;
        $videoDto->updDt = $video->UPD_DT;
        $videoDto->updId = $video->UPD_ID;
        $videoDto->crtName = $video->CRT_NAME;
        $videoDto->updName = $video->UPD_NAME;

        // Hình ảnh đại diện
        if (isset($video->images) && count($video->images) > 0) {
            foreach ($video->images as $index => $image) {
                $imageUpload = DocumentStorageDetailDto::createEmpty();
                $imageUpload->id = $image->ID;
                $imageUpload->name = $image->NAME;
                $imageUpload->originalName = $image->ORIGINAL_NAME;
                $imageUpload->extension = $image->EXTENSION;
                $imageUpload->path = $image->PATH;
                $imageUpload->directory = $image->DIRECTORY;
                $imageUpload->size = $image->SIZE;
                $imageUpload->md5 = $image->MD5;
                $imageUpload->typeFile = $image->TYPE_FILE;
                $imageUpload->description = $image->DESCRIPTION;

                $imageUpload->crtId = $image->CRT_ID;
                $imageUpload->crtName = $image->CRT_NAME;
                $imageUpload->crtDt = $image->CRT_DT;
                $imageUpload->updId = $image->UPD_ID;
                $imageUpload->updName = $image->UPD_NAME;
                $imageUpload->updDt = $image->UPD_DT;
                if (!is_null($image->IS_ACTIVE)) $imageUpload->isActive = filter_var($image->IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);

                // Pivot
                $imageUpload->sortOrder = $image->pivot->SORT_ORDER;
                $imageUpload->type = $image->pivot->ATTR1;
                $imageUpload->isThumnail = $image->pivot->IS_THUMNAIL;
                $imageUpload->aspectRatio = $image->pivot->ATTR2 ?? '1x1';

                // Thêm vào danh sách mảng
                $videoDto->danhSachHinhAnhDaiDien[] = $imageUpload;
            }
        }

        // File đính kèm
        if (isset($video->files) && count($video->files) > 0) {
            foreach ($video->files as $index => $file) {
                $fileUpload = DocumentStorageDetailDto::createEmpty();
                $fileUpload->id = $file->ID;
                $fileUpload->name = $file->NAME;
                $fileUpload->originalName = $file->ORIGINAL_NAME;
                $fileUpload->extension = $file->EXTENSION;
                $fileUpload->path = $file->PATH;
                $fileUpload->directory = $file->DIRECTORY;
                $fileUpload->size = $file->SIZE;
                $fileUpload->md5 = $file->MD5;
                $fileUpload->typeFile = $file->TYPE_FILE;
                $fileUpload->description = $file->DESCRIPTION;

                $fileUpload->crtId = $file->CRT_ID;
                $fileUpload->crtName = $file->CRT_NAME;
                $fileUpload->crtDt = $file->CRT_DT;
                $fileUpload->updId = $file->UPD_ID;
                $fileUpload->updName = $file->UPD_NAME;
                $fileUpload->updDt = $file->UPD_DT;
                if (!is_null($file->IS_ACTIVE)) $fileUpload->isActive = filter_var($file->IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);

                // Pivot
                $fileUpload->sortOrder = $file->pivot->SORT_ORDER;
                $fileUpload->type = $file->pivot->ATTR1;
                $fileUpload->isThumnail = $file->pivot->IS_THUMNAIL;
                $fileUpload->aspectRatio = '1x1';

                // Thêm vào danh sách mảng
                $videoDto->danhSachFileDinhKem[] = $fileUpload;
            }
        }

        // ATTR fields
        $videoDto->attr1 = $video->ATTR1;
        $videoDto->attr2 = $video->ATTR2;
        $videoDto->attr3 = $video->ATTR3;
        $videoDto->attr4 = $video->ATTR4;
        $videoDto->attr5 = $video->ATTR5;
        $videoDto->attr6 = $video->ATTR6;
        $videoDto->attr7 = $video->ATTR7;
        $videoDto->attr8 = $video->ATTR8;
        $videoDto->attr9 = $video->ATTR9;
        $videoDto->attr10 = $video->ATTR10;
        $videoDto->attr11 = $video->ATTR11;
        $videoDto->attr12 = $video->ATTR12;
        $videoDto->attr13 = $video->ATTR13;
        $videoDto->attr14 = $video->ATTR14;
        $videoDto->attr15 = $video->ATTR15;
        $videoDto->attr16 = $video->ATTR16;
        $videoDto->attr17 = $video->ATTR17;
        $videoDto->attr18 = $video->ATTR18;
        $videoDto->attr19 = $video->ATTR19;
        $videoDto->attr20 = $video->ATTR20;
        $videoDto->attr21 = $video->ATTR21;
        $videoDto->attr22 = $video->ATTR22;
        $videoDto->attr23 = $video->ATTR23;
        $videoDto->attr24 = $video->ATTR24;
        $videoDto->attr25 = $video->ATTR25;
        $videoDto->attr26 = $video->ATTR26;
        $videoDto->attr27 = $video->ATTR27;
        $videoDto->attr28 = $video->ATTR28;
        $videoDto->attr29 = $video->ATTR29;
        $videoDto->attr30 = $video->ATTR30;
        $videoDto->attr31 = $video->ATTR31;
        $videoDto->attr32 = $video->ATTR32;
        $videoDto->attr33 = $video->ATTR33;
        $videoDto->attr34 = $video->ATTR34;
        $videoDto->attr35 = $video->ATTR35;
        $videoDto->attr36 = $video->ATTR36;
        $videoDto->attr37 = $video->ATTR37;
        $videoDto->attr38 = $video->ATTR38;
        $videoDto->attr39 = $video->ATTR39;
        $videoDto->attr40 = $video->ATTR40;
        $videoDto->attr41 = $video->ATTR41;
        $videoDto->attr42 = $video->ATTR42;
        $videoDto->attr43 = $video->ATTR43;
        $videoDto->attr44 = $video->ATTR44;
        $videoDto->attr45 = $video->ATTR45;
        $videoDto->attr46 = $video->ATTR46;
        $videoDto->attr47 = $video->ATTR47;
        $videoDto->attr48 = $video->ATTR48;
        $videoDto->attr49 = $video->ATTR49;
        $videoDto->attr50 = $video->ATTR50;

        return $videoDto;
    }

    public static function mapVideoDetailListDtoFromEntity($video): ?VideoDetailDto {
        if ($video == null) return null;

        $videoDto = VideoDetailDto::createEmpty();

        $videoDto->id = $video->ID;
        $videoDto->title = $video->TITLE;
        $videoDto->titleSlug = convertStrToSlug($video->TITLE);
        $videoDto->summary = $video->SUMMARY;
        $videoDto->contentFormat = $video->CONTENT_FORMAT;
        $videoDto->contentRaw = $video->CONTENT_RAW;
        $videoDto->contentOnlyText = strip_tags($video->CONTENT_FORMAT);
        $videoDto->metaSeoKeywords = $video->META_SEO_KEYWORDS;
        $videoDto->metaSeoDescription = $video->META_SEO_DESCRIPTION;
        $videoDto->isHotVideo = $video->IS_HOT_VIDEO;
        $videoDto->countViews = $video->COUNT_VIEWS;
        $videoDto->isActive = $video->IS_ACTIVE;
        $videoDto->status = $video->STATUS;
        $videoDto->crtDt = $video->CRT_DT;
        $videoDto->crtId = $video->CRT_ID;
        $videoDto->updDt = $video->UPD_DT;
        $videoDto->updId = $video->UPD_ID;
        $videoDto->crtName = $video->CRT_NAME;
        $videoDto->updName = $video->UPD_NAME;

        // Avatar hình đại diện (chuẩn news)
        if (!is_null($video->OBJ_AVATAR_ID)) {
            $avatarUpload = DocumentStorageDetailDto::createEmpty();
            $avatarUpload->id = $video->OBJ_AVATAR_ID;
            $avatarUpload->name = $video->OBJ_AVATAR_NAME;
            $avatarUpload->originalName = $video->OBJ_AVATAR_ORIGINAL_NAME;
            $avatarUpload->extension = $video->OBJ_AVATAR_EXTENSION;
            $avatarUpload->path = $video->OBJ_AVATAR_PATH;
            $avatarUpload->directory = $video->OBJ_AVATAR_DIRECTORY;
            $avatarUpload->size = $video->OBJ_AVATAR_SIZE;
            $avatarUpload->md5 = $video->OBJ_AVATAR_MD5;
            $avatarUpload->typeFile = $video->OBJ_AVATAR_TYPE_FILE;
            $avatarUpload->description = $video->OBJ_AVATAR_DESCRIPTION;
            $avatarUpload->crtId = $video->OBJ_AVATAR_CRT_ID;
            $avatarUpload->crtName = $video->OBJ_AVATAR_CRT_NAME;
            $avatarUpload->crtDt = $video->OBJ_AVATAR_CRT_DT;
            $avatarUpload->updId = $video->OBJ_AVATAR_UPD_ID;
            $avatarUpload->updName = $video->OBJ_AVATAR_UPD_NAME;
            $avatarUpload->updDt = $video->OBJ_AVATAR_UPD_DT;
            if (!is_null($video->OBJ_AVATAR_IS_ACTIVE)) $avatarUpload->isActive = filter_var($video->OBJ_AVATAR_IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);
            $avatarUpload->sortOrder = $video->OBJ_AVATAR_SORT_ORDER;
            $avatarUpload->type = $video->OBJ_AVATAR_TYPE;
            $avatarUpload->isThumnail = $video->OBJ_AVATAR_IS_THUMNAIL;
            $avatarUpload->aspectRatio = $video->OBJ_AVATAR_ASPECT_RATIO ?? '1x1';
            $videoDto->danhSachHinhAnhDaiDien = [$avatarUpload];
        } else {
            $videoDto->danhSachHinhAnhDaiDien = [];
        }

        // Các trường ATTR động
        $videoDto->attr1 = $video->ATTR1;
        $videoDto->attr2 = $video->ATTR2;
        $videoDto->attr3 = $video->ATTR3;
        $videoDto->attr4 = $video->ATTR4;
        $videoDto->attr5 = $video->ATTR5;
        $videoDto->attr6 = $video->ATTR6;
        $videoDto->attr7 = $video->ATTR7;
        $videoDto->attr8 = $video->ATTR8;
        $videoDto->attr9 = $video->ATTR9;
        $videoDto->attr10 = $video->ATTR10;
        $videoDto->attr11 = $video->ATTR11;
        $videoDto->attr12 = $video->ATTR12;
        $videoDto->attr13 = $video->ATTR13;
        $videoDto->attr14 = $video->ATTR14;
        $videoDto->attr15 = $video->ATTR15;
        $videoDto->attr16 = $video->ATTR16;
        $videoDto->attr17 = $video->ATTR17;
        $videoDto->attr18 = $video->ATTR18;
        $videoDto->attr19 = $video->ATTR19;
        $videoDto->attr20 = $video->ATTR20;
        $videoDto->attr21 = $video->ATTR21;
        $videoDto->attr22 = $video->ATTR22;
        $videoDto->attr23 = $video->ATTR23;
        $videoDto->attr24 = $video->ATTR24;
        $videoDto->attr25 = $video->ATTR25;
        $videoDto->attr26 = $video->ATTR26;
        $videoDto->attr27 = $video->ATTR27;
        $videoDto->attr28 = $video->ATTR28;
        $videoDto->attr29 = $video->ATTR29;
        $videoDto->attr30 = $video->ATTR30;
        $videoDto->attr31 = $video->ATTR31;
        $videoDto->attr32 = $video->ATTR32;
        $videoDto->attr33 = $video->ATTR33;
        $videoDto->attr34 = $video->ATTR34;
        $videoDto->attr35 = $video->ATTR35;
        $videoDto->attr36 = $video->ATTR36;
        $videoDto->attr37 = $video->ATTR37;
        $videoDto->attr38 = $video->ATTR38;
        $videoDto->attr39 = $video->ATTR39;
        $videoDto->attr40 = $video->ATTR40;
        $videoDto->attr41 = $video->ATTR41;
        $videoDto->attr42 = $video->ATTR42;
        $videoDto->attr43 = $video->ATTR43;
        $videoDto->attr44 = $video->ATTR44;
        $videoDto->attr45 = $video->ATTR45;
        $videoDto->attr46 = $video->ATTR46;
        $videoDto->attr47 = $video->ATTR47;
        $videoDto->attr48 = $video->ATTR48;
        $videoDto->attr49 = $video->ATTR49;
        $videoDto->attr50 = $video->ATTR50;

        return $videoDto;
    }

    public static function mapListVideoDetailFromPaginator(Collection $listVideos): Collection {
        return $listVideos->map(function ($video) {
            return self::mapVideoDetailListDtoFromEntity($video);
        });
    }

    private static function issetkey($array, $fieldName, $defaultValue = null) {
        return isset($array[$fieldName]) ? $array[$fieldName] : $defaultValue;
    }
}
