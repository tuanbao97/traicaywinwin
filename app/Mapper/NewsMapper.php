<?php

namespace App\Mapper;

use App\Dto\categoryN\CategoryNDetailDto;
use App\Dto\documentStorage\DocumentStorageDetailDto;
use App\Dto\news\NewsDetailDto;
use App\Dto\user\UserDetailDto;
use App\Enum\AppConstant;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class NewsMapper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function mapFromArray(News $news, array $data) : ?News {
        if ($news == null) return null;
        
        $news->ID = self::issetkey($data, 'ID');
        $news->TITLE = self::issetkey($data, 'TIEU_DE_TIN_TUC');
        $news->SUMMARY = self::issetkey($data, 'TOM_TAT_TIN_TUC');
        $news->CONTENT_FORMAT = self::issetkey($data, 'NOI_DUNG_TIN_TUC');
        $news->CONTENT_RAW = self::issetkey($data, 'NOI_DUNG_TIN_TUC_ONLY_TEXT');
        $news->META_SEO_KEYWORDS = self::issetkey($data, 'META_SEO_KEYWORDS');
        $news->META_SEO_DESCRIPTION = self::issetkey($data, 'META_SEO_DESCRIPTION');
        $news->IS_APPROVED = filter_var(self::issetkey($data, 'TRANG_THAI_XUAT_BAN', false), FILTER_VALIDATE_BOOLEAN);
        $news->PUBLISHED_DATE = $news->IS_APPROVED ? self::issetkey($data, 'PUBLISHED_DATE', Carbon::now()) : null;
        $news->IS_HOT_NEWS = filter_var(self::issetkey($data, 'TIN_TUC_NOI_BAT', false), FILTER_VALIDATE_BOOLEAN);
        $news->IS_ACTIVE = filter_var(self::issetkey($data, 'TRANG_THAI_HOAT_DONG', true), FILTER_VALIDATE_BOOLEAN);
        $news->COUNT_VIEWS = self::issetkey($data, 'COUNT_VIEWS', 0);

        // Lấy thông tin người dùng từ Auth Guard
        $user = Auth::user();
        
        if ($user) {
            if (is_null($news->ID)) { // Trường hợp tạo mới
                $news->CRT_ID = $user->ID;
                $news->CRT_NAME = $user->FULL_NAME;
                $news->CRT_DT = Carbon::now();
                $news->USER_POST_NEWS_ID = $user->ID;
            }
    
            $news->UPD_ID = $user->ID;
            $news->UPD_NAME = $user->FULL_NAME;
            $news->UPD_DT = Carbon::now();

            if ($news->IS_APPROVED && is_null($news->USER_APPROVED_POST_NEWS_ID)) {
                $news->USER_APPROVED_POST_NEWS_ID = $user->ID;
                $news->APPROVED_DATE = Carbon::now();
            } else if (!$news->IS_APPROVED) {
                $news->USER_APPROVED_POST_NEWS_ID = null;
                $news->APPROVED_DATE = null;
            }
        }

        return $news;
    }
    
    public static function mapNewsDetailDtoFromEntity($news): ?NewsDetailDto {
        if ($news == null) return null;

        $newsDto = NewsDetailDto::createEmpty();

        $newsDto->id = $news->ID;
        $newsDto->title = $news->TITLE;
        $newsDto->titleSlug = convertStrToSlug($news->TITLE);
        $newsDto->summary = $news->SUMMARY;
        $newsDto->contentFormat = normalizeStorefrontRichHtml(convertMediaPathsToAbsolute($news->CONTENT_FORMAT));
        $newsDto->contentRaw = $news->CONTENT_RAW;
        $newsDto->contentOnlyText = strip_tags($news->CONTENT_FORMAT);
        $newsDto->metaSeoKeywords = $news->META_SEO_KEYWORDS;
        $newsDto->metaSeoDescription = $news->META_SEO_DESCRIPTION;
        $newsDto->approvedDate = $news->APPROVED_DATE;
        $newsDto->publishedDate = $news->PUBLISHED_DATE;
        $newsDto->isHotNews = $news->IS_HOT_NEWS;
        $newsDto->countViews = $news->COUNT_VIEWS;
        $newsDto->isApproved = $news->IS_APPROVED;
        $newsDto->userPostNewsId = $news->USER_POST_NEWS_ID;
        $newsDto->userApprovedPostNewsId = $news->USER_APPROVED_POST_NEWS_ID;
        $newsDto->isActive = $news->IS_ACTIVE;
        $newsDto->status = $news->STATUS;
        $newsDto->crtDt = $news->CRT_DT;
        $newsDto->crtId = $news->CRT_ID;
        $newsDto->updDt = $news->UPD_DT;
        $newsDto->updId = $news->UPD_ID;
        $newsDto->crtName = $news->CRT_NAME;
        $newsDto->updName = $news->UPD_NAME;

        // Avatar hình đại diện
        if (isset($news->avatars) && count($news->avatars) > 0) {
            foreach ($news->avatars as $index => $avatar) {
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

                $avatarUpload->crtId = $avatar->CRT_ID;
                $avatarUpload->crtName = $avatar->CRT_NAME;
                $avatarUpload->crtDt = $avatar->CRT_DT;
                $avatarUpload->updId = $avatar->UPD_ID;
                $avatarUpload->updName = $avatar->UPD_NAME;
                $avatarUpload->updDt = $avatar->UPD_DT;
                if (!is_null($avatar->IS_ACTIVE)) $avatarUpload->isActive = filter_var($avatar->IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);

                // Pivot
                $avatarUpload->sortOrder = $avatar->pivot->SORT_ORDER;
                $avatarUpload->type = $avatar->pivot->ATTR1;
                $avatarUpload->isThumnail = $avatar->pivot->IS_THUMNAIL;
                $avatarUpload->aspectRatio = $avatar->pivot->ATTR2 ?? '1x1';

                // Thêm vào danh sách mảng
                $newsDto->danhSachHinhAnhDaiDien[] = $avatarUpload;
            }
        }

        // Hình ảnh upload
        if (isset($news->images) && count($news->images) > 0) {
            foreach ($news->images as $index => $image) {
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
                $newsDto->danhSachHinhAnh[] = $imageUpload;
            }
        }

        // Video upload
        if (isset($news->videos) && count($news->videos) > 0) {
            foreach ($news->videos as $index => $video) {
                $videoUpload = DocumentStorageDetailDto::createEmpty();
                $videoUpload->id = $video->ID;
                $videoUpload->name = $video->NAME;
                $videoUpload->originalName = $video->ORIGINAL_NAME;
                $videoUpload->extension = $video->EXTENSION;
                $videoUpload->path = $video->PATH;
                $videoUpload->directory = $video->DIRECTORY;
                $videoUpload->size = $video->SIZE;
                $videoUpload->md5 = $video->MD5;
                $videoUpload->typeFile = $video->TYPE_FILE;
                $videoUpload->description = $video->DESCRIPTION;
                $videoUpload->imageThumnail = $video->ATTR1;

                $videoUpload->crtId = $video->CRT_ID;
                $videoUpload->crtName = $video->CRT_NAME;
                $videoUpload->crtDt = $video->CRT_DT;
                $videoUpload->updId = $video->UPD_ID;
                $videoUpload->updName = $video->UPD_NAME;
                $videoUpload->updDt = $video->UPD_DT;
                if (!is_null($video->IS_ACTIVE)) $videoUpload->isActive = filter_var($video->IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);

                // Pivot
                $videoUpload->sortOrder = $video->pivot->SORT_ORDER;
                $videoUpload->type = $video->pivot->ATTR1;
                $videoUpload->isThumnail = $video->pivot->IS_THUMNAIL;
                $videoUpload->aspectRatio = $video->pivot->ATTR2 ?? '1x1';

                // Thêm vào danh sách mảng
                $newsDto->danhSachVideo[] = $videoUpload;
            }
        }

        // File đính kèm upload
        if (isset($news->files) && count($news->files) > 0) {
            foreach ($news->files as $index => $file) {
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
                $fileUpload->imageThumnail = $file->ATTR1;

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
                $fileUpload->aspectRatio = $file->pivot->ATTR2 ?? '1x1';

                // Thêm vào danh sách mảng
                $newsDto->danhSachFileDinhKem[] = $fileUpload;
            }
        }

        // Danh mục tin tức
        if (isset($news->categories) && count($news->categories) > 0) {
            $category = $news->categories->first();
            $categoryDto = CategoryNDetailDto::createEmpty();
            $categoryDto->id = $category->ID;
            $categoryDto->name = $category->NAME;
            $categoryDto->description = $category->DESCRIPTION;
            $categoryDto->isActive = $category->IS_ACTIVE;
            $categoryDto->status = $category->STATUS;
            $categoryDto->crtDt = $category->CRT_DT;
            $categoryDto->crtId = $category->CRT_ID;
            $categoryDto->updDt = $category->UPD_DT;
            $categoryDto->updId = $category->UPD_ID;
            $categoryDto->crtName = $category->CRT_NAME;
            $categoryDto->updName = $category->UPD_NAME;

            $newsDto->danhMucTinTuc = $categoryDto;
        }

        // Người tạo
        if (isset($news->user)) {
            $userDto = UserDetailDto::createEmpty();
            $userDto->id = $news->user->ID;
            $userDto->fullName = $news->user->FULL_NAME;
            $userDto->email = $news->user->EMAIL;
            $userDto->isActive = $news->user->IS_ACTIVE;
            $userDto->status = $news->user->STATUS;
            $userDto->crtDt = $news->user->CRT_DT;
            $userDto->crtId = $news->user->CRT_ID;
            $userDto->updDt = $news->user->UPD_DT;
            $userDto->updId = $news->user->UPD_ID;
            $userDto->crtName = $news->user->CRT_NAME;
            $userDto->updName = $news->user->UPD_NAME;

            $newsDto->nguoiTao = $userDto;
        }

        // Người approved
        if (isset($news->approvedUser)) {
            $approvedUserDto = UserDetailDto::createEmpty();
            $approvedUserDto->id = $news->approvedUser->ID;
            $approvedUserDto->fullName = $news->approvedUser->FULL_NAME;
            $approvedUserDto->email = $news->approvedUser->EMAIL;
            $approvedUserDto->isActive = $news->approvedUser->IS_ACTIVE;
            $approvedUserDto->status = $news->approvedUser->STATUS;
            $approvedUserDto->crtDt = $news->approvedUser->CRT_DT;
            $approvedUserDto->crtId = $news->approvedUser->CRT_ID;
            $approvedUserDto->updDt = $news->approvedUser->UPD_DT;
            $approvedUserDto->updId = $news->approvedUser->UPD_ID;
            $approvedUserDto->crtName = $news->approvedUser->CRT_NAME;
            $approvedUserDto->updName = $news->approvedUser->UPD_NAME;

            $newsDto->nguoiApproved = $approvedUserDto;
        }

        // ATTR fields
        $newsDto->attr1 = $news->ATTR1;
        $newsDto->attr2 = $news->ATTR2;
        $newsDto->attr3 = $news->ATTR3;
        $newsDto->attr4 = $news->ATTR4;
        $newsDto->attr5 = $news->ATTR5;
        $newsDto->attr6 = $news->ATTR6;
        $newsDto->attr7 = $news->ATTR7;
        $newsDto->attr8 = $news->ATTR8;
        $newsDto->attr9 = $news->ATTR9;
        $newsDto->attr10 = $news->ATTR10;
        $newsDto->attr11 = $news->ATTR11;
        $newsDto->attr12 = $news->ATTR12;
        $newsDto->attr13 = $news->ATTR13;
        $newsDto->attr14 = $news->ATTR14;
        $newsDto->attr15 = $news->ATTR15;
        $newsDto->attr16 = $news->ATTR16;
        $newsDto->attr17 = $news->ATTR17;
        $newsDto->attr18 = $news->ATTR18;
        $newsDto->attr19 = $news->ATTR19;
        $newsDto->attr20 = $news->ATTR20;
        $newsDto->attr21 = $news->ATTR21;
        $newsDto->attr22 = $news->ATTR22;
        $newsDto->attr23 = $news->ATTR23;
        $newsDto->attr24 = $news->ATTR24;
        $newsDto->attr25 = $news->ATTR25;
        $newsDto->attr26 = $news->ATTR26;
        $newsDto->attr27 = $news->ATTR27;
        $newsDto->attr28 = $news->ATTR28;
        $newsDto->attr29 = $news->ATTR29;
        $newsDto->attr30 = $news->ATTR30;
        $newsDto->attr31 = $news->ATTR31;
        $newsDto->attr32 = $news->ATTR32;
        $newsDto->attr33 = $news->ATTR33;
        $newsDto->attr34 = $news->ATTR34;
        $newsDto->attr35 = $news->ATTR35;
        $newsDto->attr36 = $news->ATTR36;
        $newsDto->attr37 = $news->ATTR37;
        $newsDto->attr38 = $news->ATTR38;
        $newsDto->attr39 = $news->ATTR39;
        $newsDto->attr40 = $news->ATTR40;
        $newsDto->attr41 = $news->ATTR41;
        $newsDto->attr42 = $news->ATTR42;
        $newsDto->attr43 = $news->ATTR43;
        $newsDto->attr44 = $news->ATTR44;
        $newsDto->attr45 = $news->ATTR45;
        $newsDto->attr46 = $news->ATTR46;
        $newsDto->attr47 = $news->ATTR47;
        $newsDto->attr48 = $news->ATTR48;
        $newsDto->attr49 = $news->ATTR49;
        $newsDto->attr50 = $news->ATTR50;

        return $newsDto;
    }

    public static function mapNewsDetailListDtoFromEntity($news): ?NewsDetailDto {
        if ($news == null) return null;

        $newsDto = NewsDetailDto::createEmpty();

        $newsDto->id = $news->ID;
        $newsDto->title = $news->TITLE;
        $newsDto->titleSlug = convertStrToSlug($news->TITLE);
        $newsDto->summary = $news->SUMMARY;
        $newsDto->contentFormat = $news->CONTENT_FORMAT;
        $newsDto->contentRaw = $news->CONTENT_RAW;
        $newsDto->contentOnlyText = strip_tags($news->CONTENT_FORMAT);
        $newsDto->metaSeoKeywords = $news->META_SEO_KEYWORDS;
        $newsDto->metaSeoDescription = $news->META_SEO_DESCRIPTION;
        $newsDto->approvedDate = $news->APPROVED_DATE;
        $newsDto->publishedDate = $news->PUBLISHED_DATE;
        $newsDto->isHotNews = $news->IS_HOT_NEWS;
        $newsDto->countViews = $news->COUNT_VIEWS;
        $newsDto->isApproved = $news->IS_APPROVED;
        $newsDto->userPostNewsId = $news->USER_POST_NEWS_ID;
        $newsDto->userApprovedPostNewsId = $news->USER_APPROVED_POST_NEWS_ID;
        $newsDto->isActive = $news->IS_ACTIVE;
        $newsDto->status = $news->STATUS;
        $newsDto->crtDt = $news->CRT_DT;
        $newsDto->crtId = $news->CRT_ID;
        $newsDto->updDt = $news->UPD_DT;
        $newsDto->updId = $news->UPD_ID;
        $newsDto->crtName = $news->CRT_NAME;
        $newsDto->updName = $news->UPD_NAME;

        // Avatar hình đại diện (chuẩn product)
        if (!is_null($news->OBJ_AVATAR_ID)) {
            $avatarUpload = DocumentStorageDetailDto::createEmpty();
            $avatarUpload->id = $news->OBJ_AVATAR_ID;
            $avatarUpload->name = $news->OBJ_AVATAR_NAME;
            $avatarUpload->originalName = $news->OBJ_AVATAR_ORIGINAL_NAME;
            $avatarUpload->extension = $news->OBJ_AVATAR_EXTENSION;
            $avatarUpload->path = $news->OBJ_AVATAR_PATH;
            $avatarUpload->directory = $news->OBJ_AVATAR_DIRECTORY;
            $avatarUpload->size = $news->OBJ_AVATAR_SIZE;
            $avatarUpload->md5 = $news->OBJ_AVATAR_MD5;
            $avatarUpload->typeFile = $news->OBJ_AVATAR_TYPE_FILE;
            $avatarUpload->description = $news->OBJ_AVATAR_DESCRIPTION;
            $avatarUpload->crtId = $news->OBJ_AVATAR_CRT_ID;
            $avatarUpload->crtName = $news->OBJ_AVATAR_CRT_NAME;
            $avatarUpload->crtDt = $news->OBJ_AVATAR_CRT_DT;
            $avatarUpload->updId = $news->OBJ_AVATAR_UPD_ID;
            $avatarUpload->updName = $news->OBJ_AVATAR_UPD_NAME;
            $avatarUpload->updDt = $news->OBJ_AVATAR_UPD_DT;
            if (!is_null($news->OBJ_AVATAR_IS_ACTIVE)) $avatarUpload->isActive = filter_var($news->OBJ_AVATAR_IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);
            $avatarUpload->sortOrder = $news->OBJ_AVATAR_SORT_ORDER;
            $avatarUpload->type = $news->OBJ_AVATAR_TYPE;
            $avatarUpload->isThumnail = $news->OBJ_AVATAR_IS_THUMNAIL;
            $avatarUpload->aspectRatio = $news->OBJ_AVATAR_ASPECT_RATIO ?? '1x1';
            $newsDto->danhSachHinhAnhDaiDien = [$avatarUpload];
        } else {
            $newsDto->danhSachHinhAnhDaiDien = [];
        }

        // Danh mục tin tức (chuẩn product)
        if (!is_null($news->OBJ_CATEGORY_ID)) {
            $danhMucTinTuc = CategoryNDetailDto::createEmpty();
            $danhMucTinTuc->id = $news->OBJ_CATEGORY_ID;
            $danhMucTinTuc->name = $news->OBJ_CATEGORY_NAME;
            $danhMucTinTuc->parentId = $news->OBJ_CATEGORY_PARENT_ID;
            $danhMucTinTuc->sortOrder = $news->OBJ_CATEGORY_SORT_ORDER;
            $danhMucTinTuc->description = $news->OBJ_CATEGORY_DESCRIPTION;
            $danhMucTinTuc->treeLevel = $news->OBJ_CATEGORY_TREE_LEVEL;
            $danhMucTinTuc->crtId = $news->OBJ_CATEGORY_CRT_ID;
            $danhMucTinTuc->crtName = $news->OBJ_CATEGORY_CRT_NAME;
            $danhMucTinTuc->crtDt = $news->OBJ_CATEGORY_CRT_DT;
            $danhMucTinTuc->updId = $news->OBJ_CATEGORY_UPD_ID;
            $danhMucTinTuc->updName = $news->OBJ_CATEGORY_UPD_NAME;
            $danhMucTinTuc->updDt = $news->OBJ_CATEGORY_UPD_DT;
            if (!is_null($news->OBJ_CATEGORY_IS_ACTIVE)) $danhMucTinTuc->isActive = filter_var($news->OBJ_CATEGORY_IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);
            $newsDto->danhMucTinTuc = $danhMucTinTuc;
        } else {
            $newsDto->danhMucTinTuc = null;
        }

        // User tạo (chuẩn product)
        if (!is_null($news->OBJ_USER_ID)) {
            $userDto = UserDetailDto::createEmpty();
            $userDto->id = $news->OBJ_USER_ID;
            $userDto->fullName = $news->OBJ_USER_FULL_NAME;
            $userDto->email = $news->OBJ_USER_EMAIL;
            $userDto->isActive = $news->OBJ_USER_IS_ACTIVE;
            $userDto->status = $news->OBJ_USER_STATUS;
            $userDto->crtDt = $news->OBJ_USER_CRT_DT;
            $userDto->crtId = $news->OBJ_USER_CRT_ID;
            $userDto->updDt = $news->OBJ_USER_UPD_DT;
            $userDto->updId = $news->OBJ_USER_UPD_ID;
            $userDto->crtName = $news->OBJ_USER_CRT_NAME;
            $userDto->updName = $news->OBJ_USER_UPD_NAME;
            $newsDto->nguoiTao = $userDto;
        } else {
            $newsDto->nguoiTao = null;
        }

        // Các trường ATTR động
        $newsDto->attr1 = $news->ATTR1;
        $newsDto->attr2 = $news->ATTR2;
        $newsDto->attr3 = $news->ATTR3;
        $newsDto->attr4 = $news->ATTR4;
        $newsDto->attr5 = $news->ATTR5;
        $newsDto->attr6 = $news->ATTR6;
        $newsDto->attr7 = $news->ATTR7;
        $newsDto->attr8 = $news->ATTR8;
        $newsDto->attr9 = $news->ATTR9;
        $newsDto->attr10 = $news->ATTR10;
        $newsDto->attr11 = $news->ATTR11;
        $newsDto->attr12 = $news->ATTR12;
        $newsDto->attr13 = $news->ATTR13;
        $newsDto->attr14 = $news->ATTR14;
        $newsDto->attr15 = $news->ATTR15;
        $newsDto->attr16 = $news->ATTR16;
        $newsDto->attr17 = $news->ATTR17;
        $newsDto->attr18 = $news->ATTR18;
        $newsDto->attr19 = $news->ATTR19;
        $newsDto->attr20 = $news->ATTR20;
        $newsDto->attr21 = $news->ATTR21;
        $newsDto->attr22 = $news->ATTR22;
        $newsDto->attr23 = $news->ATTR23;
        $newsDto->attr24 = $news->ATTR24;
        $newsDto->attr25 = $news->ATTR25;
        $newsDto->attr26 = $news->ATTR26;
        $newsDto->attr27 = $news->ATTR27;
        $newsDto->attr28 = $news->ATTR28;
        $newsDto->attr29 = $news->ATTR29;
        $newsDto->attr30 = $news->ATTR30;
        $newsDto->attr31 = $news->ATTR31;
        $newsDto->attr32 = $news->ATTR32;
        $newsDto->attr33 = $news->ATTR33;
        $newsDto->attr34 = $news->ATTR34;
        $newsDto->attr35 = $news->ATTR35;
        $newsDto->attr36 = $news->ATTR36;
        $newsDto->attr37 = $news->ATTR37;
        $newsDto->attr38 = $news->ATTR38;
        $newsDto->attr39 = $news->ATTR39;
        $newsDto->attr40 = $news->ATTR40;
        $newsDto->attr41 = $news->ATTR41;
        $newsDto->attr42 = $news->ATTR42;
        $newsDto->attr43 = $news->ATTR43;
        $newsDto->attr44 = $news->ATTR44;
        $newsDto->attr45 = $news->ATTR45;
        $newsDto->attr46 = $news->ATTR46;
        $newsDto->attr47 = $news->ATTR47;
        $newsDto->attr48 = $news->ATTR48;
        $newsDto->attr49 = $news->ATTR49;
        $newsDto->attr50 = $news->ATTR50;

        return $newsDto;
    }

    public static function mapListNewsDetailFromPaginator(Collection $listNews): Collection {
        return $listNews->map(function ($news) {
            return self::mapNewsDetailListDtoFromEntity($news);
        });
    }

    private static function issetkey($array, $fieldName, $defaultValue = null) {
        return isset($array[$fieldName]) ? $array[$fieldName] : $defaultValue;
    }
} 