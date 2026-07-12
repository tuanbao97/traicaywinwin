<?php

namespace App\Repository;

interface ProductVariantRepository
{
    public function deleteAllBienTheSanPhamSanPham($productId) : bool;

    public function saveBienTheSanPhams($productId, array $productVariants);
}
