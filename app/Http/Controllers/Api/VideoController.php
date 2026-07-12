<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\video\VideoActiveRequest;
use App\Http\Requests\video\VideoDeleteRequest;
use App\Http\Requests\video\VideoDetailRequest;
use App\Http\Requests\video\VideoListRequest;
use App\Http\Requests\video\VideoSaveRequest;
use App\Service\VideoService;

class VideoController extends Controller
{
    // Inject beans
    private VideoService $videoService;

    public function __construct(VideoService $videoService) {
        $this->videoService = $videoService;
    }

    /**
     * Lưu video
     * @param $request
     * @return mixed
     */
    public function saveVideo(VideoSaveRequest $request) {
        return $this->videoService->saveVideo($request);
    }

    public function getDetailVideo($ID, VideoDetailRequest $request) {
        return $this->videoService->getDetailVideo($ID, $request);
    }

    public function deleteVideo($ID, VideoDeleteRequest $request) {
        return $this->videoService->deleteVideo($ID, $request);
    }

    public function getListVideo(VideoListRequest $request) {
        return $this->videoService->getListVideo($request);
    }

    public function getListVideoPublic(VideoListRequest $request) {
        $request->merge([
            'IS_API_PUBLIC' => true
        ]);
        return $this->videoService->getListVideo($request);
    }

    public function activeVideo($ID, VideoActiveRequest $request): mixed {
        return $this->videoService->activeVideo($ID, $request);
    }
}
