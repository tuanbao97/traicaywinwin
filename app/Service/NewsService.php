<?php

namespace App\Service;

use App\Models\News;
use Illuminate\Http\Request;

interface NewsService
{
    public function saveTinTuc(Request $request);

    public function getOrNewTinTuc($id): News;

    public function deleteAllTinTucFileDinhKems($newsId) : bool;

    public function handleSaveFileDinhKem($newsId, array $documentStorages);

    public function handleSaveDanhMucTinTucs($newsId, array $categories);

    public function deleteAllTinTucDanhMucTinTuc($newsId) : bool;

    public function getDetailTinTuc($id, Request $request);

    public function getDetailBasicTinTuc($id);

    public function deleteTinTuc($id, Request $request);

    public function getListTinTuc(Request $request);

    public function activeTinTuc($id, Request $request);
} 