<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\news\NewsActiveRequest;
use App\Http\Requests\news\NewsDeleteRequest;
use App\Http\Requests\news\NewsDetailRequest;
use App\Http\Requests\news\NewsListRequest;
use App\Http\Requests\news\NewsSaveRequest;
use App\Service\NewsService;

class NewsController extends Controller
{
    // Inject beans
    private NewsService $newsService;

    public function __construct(NewsService $newsService) {
        $this->newsService = $newsService;
    }

    /**
     * Lưu tin tức
     * @param $request
     * @return mixed
     */
    public function saveTinTuc(NewsSaveRequest $request) {
        return $this->newsService->saveTinTuc($request);
    }

    public function getDetailTinTuc($ID, NewsDetailRequest $request) {
        return $this->newsService->getDetailTinTuc($ID, $request);
    }

    public function deleteTinTuc($ID, NewsDeleteRequest $request) {
        return $this->newsService->deleteTinTuc($ID, $request);
    }

    public function getListTinTuc(NewsListRequest $request) {
        return $this->newsService->getListTinTuc($request);
    }

    public function getListTinTucPublic(NewsListRequest $request) {
        $request->merge([
            'IS_API_PUBLIC' => true
        ]);
        return $this->newsService->getListTinTuc($request);
    }

    public function activeTinTuc($ID, NewsActiveRequest $request): mixed {
        return $this->newsService->activeTinTuc($ID, $request);
    }

} 