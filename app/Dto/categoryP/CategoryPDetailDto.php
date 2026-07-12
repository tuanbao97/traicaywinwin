<?php

namespace App\Dto\categoryP;

class CategoryPDetailDto implements \JsonSerializable
{

    /**
     *  @var array<DocumentStorageDetailDto>|null
     */
    public ?array $danhSachHinhAnhDaiDien;

    /**
     * @var array<CategoryPDetailDto>|null
     */
    public ?array $danhSachChildren;

    public ?int $id;
    public ?int $parentId;
    public ?string $name;
    public ?string $nameSlug;
    public ?int $sortOrder;
    public ?string $description;
    public ?int $treeLevel;
    public ?int $countChildren;

    public ?string $pathView;
    
    public ?string $crtDt;
    public ?string $crtId;
    public ?string $updDt;
    public ?string $updId;
    public ?string $crtName;
    public ?string $updName;
    public ?string $status;
    public ?bool $isActive;

    /**
     * Create a new class instance.
     */
    public function __construct(?int $id = null, ?int $parentId = null, ?string $name = null, ?string $nameSlug = null
        , ?int $sortOrder = null, ?string $description = null, ?int $treeLevel = null, ?int $countChildren = null
        , ?array $danhSachHinhAnhDaiDien = null, ?array $danhSachChildren = null
        , ?string $crtDt = null, ?string $crtId = null, ?string $updDt = null, ?string $updId = null, ?string $crtName = null, ?string $updName = null, ?string $status = null, ?bool $isActive = null
        , ?string $pathView = null)
    {
        $this->id = $id;
        $this->parentId = $parentId;
        $this->name = $name;
        $this->nameSlug = $nameSlug;
        $this->sortOrder = $sortOrder;
        $this->description = $description;
        $this->treeLevel = $treeLevel;
        $this->countChildren = $countChildren;

        $this->danhSachHinhAnhDaiDien = $danhSachHinhAnhDaiDien;
        $this->danhSachChildren = $danhSachChildren;
        
        $this->pathView = $pathView;
        
        $this->crtDt = $crtDt;
        $this->crtId = $crtId;
        $this->updDt = $updDt;
        $this->updId = $updId;
        $this->crtName = $crtName;
        $this->updName = $updName;
        $this->status = $status;
        $this->isActive = $isActive;
    }

    public static function createEmpty() {
        return new self();
    }

    /* Hiển thị tên json thay thế */
    public function jsonSerialize(): mixed {
        return [
            'ID' => $this->id
            , 'PARENT_ID' => $this->parentId
            , 'TEN_DANH_MUC_SAN_PHAM' => $this->name
            , 'TEN_DANH_MUC_SAN_PHAM_SLUG' =>  convertStrToSlug($this->name)
            , 'SORT_ORDER' => $this->sortOrder
            , 'MO_TA' => $this->description
            , 'TREE_LEVEL' => $this->treeLevel
            , 'DANH_SACH_HINH_ANH_DAI_DIEN' => $this->danhSachHinhAnhDaiDien
            , 'DANH_SACH_CHILDREN' => $this->danhSachChildren
            , 'COUNT_CHILDREN' => $this->countChildren

            , 'PATH_VIEW' => $this->pathView
            
            , 'CRT_DT' => $this->crtDt
            , 'CRT_ID' => $this->crtId
            , 'UPD_DT' => $this->updDt
            , 'UPD_ID' => $this->updId
            , 'CRT_NAME' => $this->crtName
            , 'UPD_NAME' => $this->updName
            , 'TRANG_THAI' => $this->status
            , 'TRANG_THAI_HOAT_DONG' => $this->isActive
        ];
    }

}
