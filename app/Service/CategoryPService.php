<?php

namespace App\Service;

use App\Http\Requests\categoryp\CategoryPSaveRequest;
use App\Models\CategoryP;
use Illuminate\Http\Request;

interface CategoryPService
{
    /**
     * Save category product
     * 
     * @param CategoryPSaveRequest $request
     */
    public function save(CategoryPSaveRequest $request);

    /**
     * Get sort order lastest
     * 
     * @param CategoryP $categoryP
     */
    public function getThuTuSapXepMoiNhat();

    /**
     * Get or new categor product
     * 
     * @param int $id
     * @return CategoryP
     */
    public function getOrNewDanhMucSanPham($id) : CategoryP;

    /**
     * Get list category tree
     * 
     * @param Request $request
     */
    public function getListDanhMucSanPhamTree(Request $request);

    public function getListDanhMucSanPham(Request $request);

    public function deleteAllDanhMucSanPhamFileDinhKem($categoryPId) : bool;

    public function getDetailDanhMucSanPham($id, Request $request);

    public function deleteDanhMucSanPham($id, Request $request);

    public function activeTrangThaiHoatDong($id, Request $request);
    
}
