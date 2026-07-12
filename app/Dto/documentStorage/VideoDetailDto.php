<?php

namespace App\Dto\documentStorage;

class VideoDetailDto implements \JsonSerializable
{
    public ?int $id;
    public ?string $name;
    public ?string $originalName;
    public ?string $extension;
    public ?string $path;
    public ?string $directory;
    public ?float $size;
    public ?string $md5;
    public ?string $typeFile;
    public ?string $description;
    public ?string $imageThumnail;
    
    // Pivot
    public ?int $sortOrder;
    public ?string $type;
    public ?bool $isThumnail;

    public ?string $crtDt;
    public ?string $crtId;
    public ?string $updDt;
    public ?string $updId;
    public ?string $crtName;
    public ?string $updName;
    public ?bool $isActive;

    /**
     * Create a new class instance.
     */
    public function __construct(?int $id = null, ?string $name = null, ?string $originalName = null, ?string $extension = null
        , ?string $path = null, ?string $directory = null,  ?float $size = null, ?string $md5 = null, ?string $typeFile = null, ?string $description = null, ?string $imageThumnail = null
        , ?int $sortOrder = null, ?string $type = null, ?bool $isThumnail = null
        , ?string $crtDt = null, ?string $crtId = null, ?string $updDt = null, ?string $updId = null, ?string $crtName = null, ?string $updName = null, ?bool $isActive = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->originalName = $originalName;
        $this->extension = $extension;
        $this->path = $path;
        $this->directory = $directory;
        $this->size = $size;
        $this->md5 = $md5;
        $this->typeFile = $typeFile;
        $this->description = $description;
        $this->imageThumnail = $imageThumnail;

        // Pivot
        $this->sortOrder = $sortOrder;
        $this->type = $type;
        $this->isThumnail = $isThumnail;

        $this->crtDt = $crtDt;
        $this->crtId = $crtId;
        $this->updDt = $updDt;
        $this->updId = $updId;
        $this->crtName = $crtName;
        $this->updName = $updName;
        $this->isActive = $isActive;
    }

    public static function createEmpty(): VideoDetailDto {
        return new VideoDetailDto();
    }

    public function jsonSerialize(): mixed {
        return [
            'ID' => $this->id
            , 'NAME' => $this->name
            , 'ORIGINAL_NAME' => $this->originalName
            , 'EXTENSION' => $this->extension
            , 'PATH' => $this->path
            , 'DIRECTORY' => $this->directory
            , 'SIZE' => $this->size
            , 'MD5' => $this->md5
            , 'TYPE_FILE' => $this->typeFile
            , 'DESCRIPTION' => $this->description
            , 'IMAGE_THUMNAIL' => $this->imageThumnail

            // Pivot
            , 'SORT_ORDER' => $this->sortOrder
            , 'TYPE' => $this->type
            , 'IS_THUMNAIL' => $this->isThumnail

            , 'CRT_DT' => $this->crtDt
            , 'CRT_ID' => $this->crtId
            , 'UPD_DT' => $this->updDt
            , 'UPD_ID' => $this->updId
            , 'CRT_NAME' => $this->crtName
            , 'UPD_NAME' => $this->updName
            , 'TRANG_THAI_HOAT_DONG' => $this->isActive
        ];
    }

}
