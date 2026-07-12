<?php

namespace App\Dto\video;

use stdClass;

class VideoDetailDto implements \JsonSerializable
{
    public ?int $id;
    public ?string $title;
    public ?string $titleSlug;
    public ?string $summary;
    public ?string $contentFormat;
    public ?string $contentRaw;
    public ?string $contentOnlyText;
    public ?string $metaSeoKeywords;
    public ?string $metaSeoDescription;
    public ?bool $isHotVideo;
    public ?int $countViews;

    public ?string $status;
    public ?string $crtDt;
    public ?string $crtId;
    public ?string $updDt;
    public ?string $updId;
    public ?string $crtName;
    public ?string $updName;
    public ?bool $isActive;

    // File uploads
    public array $danhSachHinhAnhDaiDien = [];
    public array $danhSachFileDinhKem = [];

    public ?string $attr1;
    public ?string $attr2;
    public ?string $attr3;
    public ?string $attr4;
    public ?string $attr5;
    public ?string $attr6;
    public ?string $attr7;
    public ?string $attr8;
    public ?string $attr9;
    public ?string $attr10;
    public ?string $attr11;
    public ?string $attr12;
    public ?string $attr13;
    public ?string $attr14;
    public ?string $attr15;
    public ?string $attr16;
    public ?string $attr17;
    public ?string $attr18;
    public ?string $attr19;
    public ?string $attr20;
    public ?string $attr21;
    public ?string $attr22;
    public ?string $attr23;
    public ?string $attr24;
    public ?string $attr25;
    public ?string $attr26;
    public ?string $attr27;
    public ?string $attr28;
    public ?string $attr29;
    public ?string $attr30;
    public ?string $attr31;
    public ?string $attr32;
    public ?string $attr33;
    public ?string $attr34;
    public ?string $attr35;
    public ?string $attr36;
    public ?string $attr37;
    public ?string $attr38;
    public ?string $attr39;
    public ?string $attr40;
    public ?string $attr41;
    public ?string $attr42;
    public ?string $attr43;
    public ?string $attr44;
    public ?string $attr45;
    public ?string $attr46;
    public ?string $attr47;
    public ?string $attr48;
    public ?string $attr49;
    public ?string $attr50;
    
    /**
     * Create a new class instance.
     */
    public function __construct(?int $id = null, ?string $title = null, ?string $titleSlug = null
        , ?string $summary = null, ?string $contentFormat = null, ?string $contentRaw = null, ?string $contentOnlyText = null
        , ?string $metaSeoKeywords = null, ?string $metaSeoDescription = null
        , ?bool $isHotVideo = null, ?int $countViews = null
        , ?string $crtDt = null, ?string $crtId = null, ?string $updDt = null, ?string $updId = null, ?string $crtName = null, ?string $updName = null, ?bool $isActive = null, ?string $status = null
        , ?string $attr1 = null, ?string $attr2 = null, ?string $attr3 = null, ?string $attr4 = null, ?string $attr5 = null, ?string $attr6 = null, ?string $attr7 = null, ?string $attr8 = null, ?string $attr9 = null, ?string $attr10 = null, ?string $attr11 = null, ?string $attr12 = null, ?string $attr13 = null, ?string $attr14 = null, ?string $attr15 = null, ?string $attr16 = null, ?string $attr17 = null, ?string $attr18 = null, ?string $attr19 = null, ?string $attr20 = null, ?string $attr21 = null, ?string $attr22 = null, ?string $attr23 = null, ?string $attr24 = null, ?string $attr25 = null, ?string $attr26 = null, ?string $attr27 = null, ?string $attr28 = null, ?string $attr29 = null, ?string $attr30 = null, ?string $attr31 = null, ?string $attr32 = null, ?string $attr33 = null, ?string $attr34 = null, ?string $attr35 = null, ?string $attr36 = null, ?string $attr37 = null, ?string $attr38 = null, ?string $attr39 = null, ?string $attr40 = null, ?string $attr41 = null, ?string $attr42 = null, ?string $attr43 = null, ?string $attr44 = null, ?string $attr45 = null, ?string $attr46 = null, ?string $attr47 = null, ?string $attr48 = null, ?string $attr49 = null, ?string $attr50 = null
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->titleSlug = $titleSlug;
        $this->summary = $summary;
        $this->contentFormat = $contentFormat;
        $this->contentRaw = $contentRaw;
        $this->contentOnlyText = $contentOnlyText;
        $this->metaSeoKeywords = $metaSeoKeywords;
        $this->metaSeoDescription = $metaSeoDescription;
        $this->isHotVideo = $isHotVideo;
        $this->countViews = $countViews;

        $this->crtDt = $crtDt;
        $this->crtId = $crtId;
        $this->updDt = $updDt;
        $this->updId = $updId;
        $this->crtName = $crtName;
        $this->updName = $updName;
        $this->isActive = $isActive;
        $this->status = $status;

        $this->attr1 = $attr1;
        $this->attr2 = $attr2;
        $this->attr3 = $attr3;
        $this->attr4 = $attr4;
        $this->attr5 = $attr5;
        $this->attr6 = $attr6;
        $this->attr7 = $attr7;
        $this->attr8 = $attr8;
        $this->attr9 = $attr9;
        $this->attr10 = $attr10;
        $this->attr11 = $attr11;
        $this->attr12 = $attr12;
        $this->attr13 = $attr13;
        $this->attr14 = $attr14;
        $this->attr15 = $attr15;
        $this->attr16 = $attr16;
        $this->attr17 = $attr17;
        $this->attr18 = $attr18;
        $this->attr19 = $attr19;
        $this->attr20 = $attr20;
        $this->attr21 = $attr21;
        $this->attr22 = $attr22;
        $this->attr23 = $attr23;
        $this->attr24 = $attr24;
        $this->attr25 = $attr25;
        $this->attr26 = $attr26;
        $this->attr27 = $attr27;
        $this->attr28 = $attr28;
        $this->attr29 = $attr29;
        $this->attr30 = $attr30;
        $this->attr31 = $attr31;
        $this->attr32 = $attr32;
        $this->attr33 = $attr33;
        $this->attr34 = $attr34;
        $this->attr35 = $attr35;
        $this->attr36 = $attr36;
        $this->attr37 = $attr37;
        $this->attr38 = $attr38;
        $this->attr39 = $attr39;
        $this->attr40 = $attr40;
        $this->attr41 = $attr41;
        $this->attr42 = $attr42;
        $this->attr43 = $attr43;
        $this->attr44 = $attr44;
        $this->attr45 = $attr45;
        $this->attr46 = $attr46;
        $this->attr47 = $attr47;
        $this->attr48 = $attr48;
        $this->attr49 = $attr49;
        $this->attr50 = $attr50;
    }

    public static function createEmpty() : VideoDetailDto {
        return new VideoDetailDto();
    }

    public function jsonSerialize(): mixed {
        return [
            'ID' => $this->id,
            'TIEU_DE_VIDEO' => $this->title,
            'TIEU_DE_VIDEO_SLUG' => $this->titleSlug,
            'TOM_TAT_VIDEO' => $this->summary,
            'NOI_DUNG_VIDEO' => $this->contentFormat,
            'NOI_DUNG_VIDEO_ONLY_TEXT' => $this->contentOnlyText,
            'META_SEO_KEYWORDS' => $this->metaSeoKeywords,
            'META_SEO_DESCRIPTION' => $this->metaSeoDescription,
            'VIDEO_NOI_BAT' => $this->isHotVideo,
            'SO_LUOT_XEM' => $this->countViews,
            'CRT_DT' => $this->crtDt,
            'CRT_ID' => $this->crtId,
            'UPD_DT' => $this->updDt,
            'UPD_ID' => $this->updId,
            'CRT_NAME' => $this->crtName,
            'UPD_NAME' => $this->updName,
            'TRANG_THAI_HOAT_DONG' => $this->isActive,
            'TRANG_THAI' => $this->status,
            'DANH_SACH_HINH_ANH_DAI_DIEN' => $this->danhSachHinhAnhDaiDien,
            'DANH_SACH_FILE_DINH_KEM' => $this->danhSachFileDinhKem,
            'ATTR1' => $this->attr1,
            'ATTR2' => $this->attr2,
            'ATTR3' => $this->attr3,
            'ATTR4' => $this->attr4,
            'ATTR5' => $this->attr5,
            'ATTR6' => $this->attr6,
            'ATTR7' => $this->attr7,
            'ATTR8' => $this->attr8,
            'ATTR9' => $this->attr9,
            'ATTR10' => $this->attr10,
            'ATTR11' => $this->attr11,
            'ATTR12' => $this->attr12,
            'ATTR13' => $this->attr13,
            'ATTR14' => $this->attr14,
            'ATTR15' => $this->attr15,
            'ATTR16' => $this->attr16,
            'ATTR17' => $this->attr17,
            'ATTR18' => $this->attr18,
            'ATTR19' => $this->attr19,
            'ATTR20' => $this->attr20,
            'ATTR21' => $this->attr21,
            'ATTR22' => $this->attr22,
            'ATTR23' => $this->attr23,
            'ATTR24' => $this->attr24,
            'ATTR25' => $this->attr25,
            'ATTR26' => $this->attr26,
            'ATTR27' => $this->attr27,
            'ATTR28' => $this->attr28,
            'ATTR29' => $this->attr29,
            'ATTR30' => $this->attr30,
            'ATTR31' => $this->attr31,
            'ATTR32' => $this->attr32,
            'ATTR33' => $this->attr33,
            'ATTR34' => $this->attr34,
            'ATTR35' => $this->attr35,
            'ATTR36' => $this->attr36,
            'ATTR37' => $this->attr37,
            'ATTR38' => $this->attr38,
            'ATTR39' => $this->attr39,
            'ATTR40' => $this->attr40,
            'ATTR41' => $this->attr41,
            'ATTR42' => $this->attr42,
            'ATTR43' => $this->attr43,
            'ATTR44' => $this->attr44,
            'ATTR45' => $this->attr45,
            'ATTR46' => $this->attr46,
            'ATTR47' => $this->attr47,
            'ATTR48' => $this->attr48,
            'ATTR49' => $this->attr49,
            'ATTR50' => $this->attr50
        ];
    }
}