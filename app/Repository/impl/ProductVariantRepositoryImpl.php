<?php

namespace App\Repository\impl;

use App\Enum\AppConstant;
use App\Mapper\ProductCategoryMapper;
use App\Mapper\ProductVariantMapper;
use App\Models\ProductVariant;
use App\Repository\BaseRepository;
use App\Repository\ProductVariantRepository;

class ProductVariantRepositoryImpl extends BaseRepository implements ProductVariantRepository
{
    public function getModel()
    {
        return ProductVariant::class;
    }

    public function deleteAllBienTheSanPhamSanPham($productId) : bool
    {
        $isDeleted = ProductVariant::where([
            ['PRODUCT_ID', '=', $productId],
        ])->delete();
        return $isDeleted;
    }

    public function saveBienTheSanPhams($productId, array $productVariants)
    {
        if (isset($productVariants) && count($productVariants) > 0) {
            foreach ($productVariants as $index => $productVariant) {
                $data = [
                    'PRODUCT_ID' => $productId
                    , 'PRODUCT_STATUS' => $productVariant['TINH_TRANG_SAN_PHAM']
                    , 'PRODUCT_COLOR' => $productVariant['MAU_SAC']
                    , 'PRODUCT_STORAGE' => $productVariant['DUNG_LUONG']
                    , 'PRODUCT_IMAGE_ID' => $productVariant['DANH_SACH_HINH_ANH_DAI_DIEN'][0]['ID']
                    , 'IS_CONTACT_PRICE' => $productVariant['GIA_LIEN_HE']
                    , 'PRODUCT_PRICE' => $productVariant['GIA_BAN']
                    , 'PRODUCT_ORIGINAL_PRICE' => $productVariant['GIA_GOC']
                    , 'IS_IN_STOCK' => $productVariant['CON_HANG']
                ];
                $productVariant = ProductVariantMapper::mapFromArray(new ProductVariant(), $data);
                // Save
                $productVariant->save();
            }
        }
    }
}
