<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoViewController extends Controller
{
    public function loadView(Request $request)
    {
        $pathView = $request->input('pathView', null);
        $videoId = $request->input('videoId', null);
        $duLieu = $request->input('duLieu', null);
        $uuid = $request->input('uuid', null) ?? \Illuminate\Support\Str::random(6);

        return view($pathView, [
            'videoId' => $videoId,
            'duLieu' => $duLieu,
            'uuid1' => $uuid
        ]);
    }
}
