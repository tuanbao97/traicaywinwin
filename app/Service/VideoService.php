<?php

namespace App\Service;

use App\Models\Video;
use Illuminate\Http\Request;

interface VideoService
{
    public function saveVideo(Request $request);

    public function getOrNewVideo($id): Video;

    public function getDetailVideo($id, Request $request);

    public function deleteVideo($id, Request $request);

    public function getListVideo(Request $request);

    public function activeVideo($id, Request $request);
}
