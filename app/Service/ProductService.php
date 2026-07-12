<?php

namespace App\Service;

use App\Models\Product;
use Illuminate\Http\Request;

interface ProductService
{
    public function saveSanPham(Request $request);

    public function getOrNewSanPham($id): Product;

    public function deleteAllSanPhamFileDinhKems($productId) : bool;

    public function handleSaveFileDinhKem($productId,  array $documentStorages);

    public function handleSaveDanhMucSanPhams($productId,  array $categories);

    public function deleteAllSanPhamDanhMucSanPham($productId) : bool;

    public function getDetailSanPham($id, Request $request);

    public function getDetailBasicSanPham($id);

    public function deleteSanPham($id, Request $request);

    public function getListSanPham(Request $request);

    public function activeSanPham($id, Request $request);

    public function soldSanPham($id, Request $request);
    

}
