<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoryn\CategoryNActiveRequest;
use App\Http\Requests\categoryn\CategoryNDeleteRequest;
use App\Http\Requests\categoryn\CategoryNDetailRequest;
use App\Http\Requests\categoryn\CategoryNListRequest;
use App\Http\Requests\categoryn\CategoryNListTreeRequest;
use App\Http\Requests\categoryn\CategoryNSaveRequest;
use Illuminate\Http\Request;
use App\Service\CategoryNService;

class CategoryNController extends Controller
{

    // Inject beans
    private CategoryNService $categoryNService;

    public function __construct(CategoryNService $categoryNService)
    {
        $this->categoryNService = $categoryNService;
    }

    /**
     * Lưu category news
     * 
     * @param CategoryNSaveRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(CategoryNSaveRequest $request)
    {
        return $this->categoryNService->save($request);
    }

    /**
     * Get list category news tree
     *
     * @param Request $request
     */
    public function getListDanhMucTinTucTree(CategoryNListTreeRequest $request) {
        return $this->categoryNService->getListDanhMucTinTucTree($request);
    }

    public function getPublicListDanhMucTinTucTree(CategoryNListTreeRequest $request) {
        $request->merge([
            'IS_API_PUBLIC' => true
        ]);
        return $this->categoryNService->getListDanhMucTinTucTree($request);
    }

    public function getListDanhMucTinTuc(CategoryNListRequest $request) {
        return $this->categoryNService->getListDanhMucTinTuc($request);
    }

    public function getDetailDanhMucTinTuc($ID, CategoryNDetailRequest $request) {
        $categoryNDetail = $this->categoryNService->getDetailDanhMucTinTuc($ID, $request);
        return $categoryNDetail;
    }

    public function deleteDanhMucTinTuc($ID, CategoryNDeleteRequest $request) {
        return $this->categoryNService->deleteDanhMucTinTuc($ID, $request);
    }

    public function activeTrangThaiHoatDong($ID, CategoryNActiveRequest $request) {
        return $this->categoryNService->activeTrangThaiHoatDong($ID, $request);
    }

}
