<?php

namespace App\Service;

use App\Http\Requests\categoryn\CategoryNSaveRequest;
use App\Models\CategoryN;
use Illuminate\Http\Request;

interface CategoryNService
{
    /**
     * Save category product
     * 
     * @param CategoryNSaveRequest $request
     */
    public function save(CategoryNSaveRequest $request);

    /**
     * Get sort order lastest
     * 
     * @param CategoryN $categoryN
     */
    public function getThuTuSapXepMoiNhat();

    /**
     * Get or new category new
     * 
     * @param int $id
     * @return CategoryN
     */
    public function getOrNewDanhMucTinTuc($id) : CategoryN;

    /**
     * Get list category new tree
     * 
     * @param Request $request
     */
    public function getListDanhMucTinTucTree(Request $request);

    public function getListDanhMucTinTuc(Request $request);

    public function deleteAllDanhMucTinTucFileDinhKem($categoryNId) : bool;

    public function getDetailDanhMucTinTuc($id, Request $request);

    public function deleteDanhMucTinTuc($id, Request $request);

    public function activeTrangThaiHoatDong($id, Request $request);
    
}
