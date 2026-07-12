<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\CategoryPService;
use Illuminate\Http\Request;
use App\Http\Requests\categoryp\CategoryPDeleteRequest;
use App\Http\Requests\categoryp\CategoryPDetailRequest;
use App\Http\Requests\categoryp\CategoryPSaveRequest;
use App\Http\Requests\categoryp\CategoryPActiveRequest;
use App\Http\Requests\categoryp\CategoryPListRequest;
use App\Http\Requests\categoryp\CategoryPListTreeRequest;

class CategoryPController extends Controller
{

    // Inject beans
    private CategoryPService $categoryPService;

    public function __construct(CategoryPService $categoryPService)
    {
        $this->categoryPService = $categoryPService;
    }

    /**
     * Lưu category production
     * 
     * @param CategoryPSaveRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(CategoryPSaveRequest $request)
    {
        return $this->categoryPService->save($request);
    }

    /**
     * Get list category tree
     *
     * @param Request $request
     */
    public function getListDanhMucSanPhamTree(CategoryPListTreeRequest $request) {
        return $this->categoryPService->getListDanhMucSanPhamTree($request);
    }

    public function getListDanhMucSanPhamTreePublic(CategoryPListTreeRequest $request) {
        $request->merge([
            'IS_API_PUBLIC' => true
        ]);
        return $this->categoryPService->getListDanhMucSanPhamTree($request);
    }

    public function getListDanhMucSanPham(CategoryPListRequest $request) {
        return $this->categoryPService->getListDanhMucSanPham($request);
    }

    public function getListDanhMucSanPhamPublic(CategoryPListRequest $request) {
        $request->merge([
            'IS_API_PUBLIC' => true
        ]);
        return $this->categoryPService->getListDanhMucSanPham($request);
    }

    public function getDetailDanhMucSanPham($ID, CategoryPDetailRequest $request) {
        $categoryPDetail = $this->categoryPService->getDetailDanhMucSanPham($ID, $request);
        return $categoryPDetail;
    }

    public function deleteDanhMucSanPham($ID, CategoryPDeleteRequest $request) {
        return $this->categoryPService->deleteDanhMucSanPham($ID, $request);
    }

    public function activeTrangThaiHoatDong($ID, CategoryPActiveRequest $request) {
        return $this->categoryPService->activeTrangThaiHoatDong($ID, $request);
    }

}
