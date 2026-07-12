<?php

namespace App\Service\impl;

use App\Repository\ProductVariantRepository;
use App\Service\ProductVariantService;

class ProductVariantServiceImpl implements ProductVariantService
{
    // Inject beans
    private ProductVariantRepository $productVariantRepository;

    public function __construct(ProductVariantRepository $productVariantRepository)
    {
        $this->productVariantRepository = $productVariantRepository;
    }

    
}
