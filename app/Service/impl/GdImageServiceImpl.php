<?php

namespace App\Service\impl;

use App\Service\InterventionImageService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

use function PHPUnit\Framework\isNull;

class GdImageServiceImpl extends InterventionImageService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->initImageManager();
    }
    
    public function initImageManager(): self
    {
        $this->setImageManager(ImageManager::gd());
        return $this;
    }

    public function readImage($imagePath) : self
    {
        $this->setImagePath($imagePath);

        $image = $this->getImageManager()->read($this->getImagePath());
        $this->setImageInterface($image);
        return $this;
    }

    public function resize(int $chieuRong, int $chieuCao) : self 
    {
        $image = $this->getImageInterface();
        $image->resize($chieuRong, $chieuCao); // Resize theo đúng kích thước chiều rộng x chiều cao

        $this->setImageInterface($image);
        return $this;
    }

    public function scale(?int $chieuRong = null, ?int $chieuCao = null) : self 
    {
        if (is_null($chieuRong) && is_null($chieuCao)) return $this;
        
        $image = $this->getImageInterface();
        if (is_null($chieuRong)) {
            $image->scale(height: $chieuCao); // Scale ảnh theo tỉ lệ ban đầu -> chiều rộng
        } else {
            $image->scale(width: $chieuRong); // Scale ảnh theo tỉ lệ ban đầu -> chiều dài
        }
        $this->setImageInterface($image);

        return $this;
    }
    
    public function crop(int $chieuRong, int $chieuCao, $toaDoX = 0, $toaDoY = 0) : self
    {
        $image = $this->getImageInterface();
        $image->crop(width: $chieuRong, height: $chieuCao, offset_x: $toaDoX, offset_y: $toaDoY);
        $this->setImageInterface($image);
        
        return $this;
    }

    public function storeImg(?int $chatLuongHinhAnh = null): self
    {
        // Nếu không truyền $chatLuongHinhAnh, đọc từ config
        $chatLuongHinhAnh = $chatLuongHinhAnh ?? config('app.image_quality');
        
        $destPath = $this->getDestPath();
        // Kiểm tra xem thư mục đã tồn tại hay chưa
        if (!File::isDirectory($destPath)) {
            // Nếu thư mục không tồn tại, tạo mới thư mục
            File::makeDirectory($destPath, 0777, true, true);
        }

        $image = $this->getImageInterface();
        // Lưu xuống disk với chất lượng từ config (default: 70%)
        $image->save($destPath . '/' . $this->getFileName(), quality: $chatLuongHinhAnh);
        
        return $this;
    }

}
