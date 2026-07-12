<?php

namespace App\Service;

use Intervention\Image\ImageManager;
use Intervention\Image\Interfaces\ImageInterface;

abstract class InterventionImageService
{
    private ImageManager $imageManager;

    private ImageInterface $imageInterface;
    
    private String $fileName;

    private string $imagePath;

    private string $destPath;

    private int $chieuRong;

    private int $chieuCao;

    private int $toaDoX;

    private int $toaDoY;

    public function __construct() {
        // Khởi tạo giá trị mặc định
    }

    abstract public function initImageManager() : self;
    abstract public function readImage($imagePath) : self;

    /**
     * Resize theo đúng kích thước chiều rộng x chiều cao
     */
    abstract public function resize(int $chieuRong, int $chieuCao) : self;

    /**
     * Scale hình ảnh. Theo tỉ lệ còn lại. Ví dụ chiều rộng -> ra chiều cao và ngược lại. Chỉ nhập 1 trong 2 tham số
     */
    abstract public function scale(?int $chieuRong = null, ?int $chieuCao = null) : self;

    /**
     * Crop hình ảnh
     */
    abstract public function crop(int $chieuRong, int $chieuCao, $toaDoX = 0, $toaDoY = 0) : self;
    
    abstract public function storeImg(?int $chatLuongHinhAnh = null) : self;

    public function setImageManager(ImageManager $imageManager) {
        $this->imageManager = $imageManager;

        return $this;
    }

    public function getImageManager() {
        return $this->imageManager;
    }

    public function setImagePath(string $imagePath) {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getImagePath() {
        return $this->imagePath;
    }

    public function setChieuRong(int $chieuRong) {
        $this->chieuRong = $chieuRong;

        return $this;
    }
    
    public function getChieuRong() {
        return $this->chieuRong;
    }

    public function setChieuCao(int $chieuCao) {
        $this->chieuCao = $chieuCao;

        return $this;
    }
    
    public function getChieuCao() {
        return $this->chieuCao;
    }
    
    public function setDestPath(string $destPath) {
        $this->destPath = $destPath;

        return $this;
    }
    
    public function getDestPath() {
        return $this->destPath;
    }
    
    public function setToaDoX(int $toaDoX) {
        $this->toaDoX = $toaDoX;

        return $this;
    }
    
    public function getToaDoX() {
        return $this->toaDoX;
    }
    
    public function setToaDoY(string $toaDoY) {
        $this->toaDoY = $toaDoY;

        return $this;
    }
    
    public function getToaDoY() {
        return $this->toaDoY;
    }

    public function setFileName(string $fileName) {
        $this->fileName = $fileName;

        return $this;
    }
    
    public function getFileName() {
        return $this->fileName;
    }

    public function setImageInterface(ImageInterface $imageInterface) {
        $this->imageInterface = $imageInterface;

        return $this;
    }
    
    public function getImageInterface() {
        return $this->imageInterface;
    }
}

