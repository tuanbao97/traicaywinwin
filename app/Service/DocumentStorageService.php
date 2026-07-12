<?php

namespace App\Service;

use App\Http\Requests\documentStorage\DocumentStorageUploadRequest;
use App\Http\Requests\documentStorage\VideoUploadMultipleRequest;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\documentStorage\DocumentStoragesRequest;
use App\Http\Requests\documentStorage\ImageUpdateDetailRequest;
use App\Http\Requests\documentStorage\ImageUploadMultipleRequest;
use App\Models\DocumentStorage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\File as FileSymfony;

interface DocumentStorageService
{
    /**
     * Upload multiple file
     * 
     * @param DocumentStorageUploadRequest $request
     */
    public function uploadMultipleFile(DocumentStorageUploadRequest $request);

    /**
     * Upload multiple hình ảnh và nén ảnh với chất lượng thấp hơn
     */
    public function uploadMultipleHinhAnh(ImageUploadMultipleRequest $request);
    
    /**
     * Upload multiple video vàn nén chất lượng thấp hơn
     */
    public function uploadMultipleVideo(VideoUploadMultipleRequest $request);
    
    /**
     * Lưu trữ file vào thư mục dưj án
     *
     * @param UploadedFile $file
     * @param $fileNameHash
     * @param $directoryPath
     */
    public function storgeFileDinhKem(UploadedFile $file, $fileNameHash, $directoryPath) : FileSymfony;

    /**
     * Get document storage theo id
     * 
     * @param int $id
     * @param $status
     * @return DocumentStorage
     */
    public function getFileDinhKemById(int $id, $status) : ?DocumentStorage;

    /**
     * Get danh sách document storage
     * 
     * @param DocumentStoragesRequest $request
     */
    public function getListFileDinhKem(Request $request);

    /**
     * Download danh sách document storage
     * 
     * @param DocumentStoragesRequest $request
     */
    public function downloadFileDinhKems(Request $request);

    /**
     * Download file
     * 
     * @param string $filePath
     * @param string $fileName
     */
    public function downloadFileDinhKem($filePath, $fileName);

    /**
     * Download danh sách file và zip lại
     * 
     * @param $documentStorages
     * @param string $zipFileName
     */
    public function downloadZipFileDinhKem($documentStorages, $zipFileName);

    /**
     * Update chi tiết file đính kèm
     * 
     * @param $id
     * @param Request $request
     */
    public function updateChiTietFileDinhKem($id, Request $request);
    
    /**
     * Update chi tiết hình ảnh
     * 
     * @param $id
     * @param Request $request
     */
    public function updateChiTietHinhAnh($id, Request $request);

    /**
     * Lưu ảnh đã crop
     * 
     * @param $id
     * @param Request $request
     */
    public function cropHinhAnh($id, Request $request);

    /**
     * Lưu ảnh đại diện video đã crop
     * 
     * @param $id
     * @param Request $request
     */
    public function cropHinhAnhDaiDienVideo($id, Request $request);

    public function resizeImgTheoKichThuoc(string $kichThuoc, InterventionImageService $interventionImage, string $fileNameHash, string $directoryPath
        , int $chieuRong = 700, int $chatLuongAnh = 80);

    /**
     * Update chi tiết video
     * 
     * @param $id
     * @param Request $request
     */
    public function updateChiTietVideo($id, Request $request);


}