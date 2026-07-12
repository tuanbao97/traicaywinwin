<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\documentStorage\DocumentStorageUploadRequest;
use App\Http\Requests\documentStorage\VideoUploadMultipleRequest;
use App\Repository\DocumentStorageRepository;
use App\Service\DocumentStorageService;
use App\Http\Requests\documentStorage\DocumentStoragesRequest;
use App\Http\Requests\documentStorage\FileUpdateDetailRequest;
use App\Http\Requests\documentStorage\ImageCropRequest;
use App\Http\Requests\documentStorage\ImageUpdateDetailRequest;
use App\Http\Requests\documentStorage\ImageUploadMultipleRequest;
use App\Http\Requests\documentStorage\VideoUpdateDetailRequest;

class DocumentStorageController extends Controller
{
    // Inject beans
    private DocumentStorageRepository $documentStorageRepository;
    private DocumentStorageService $documentStorageService;

    public function __construct(DocumentStorageRepository $documentStorageRepository, 
        DocumentStorageService $documentStorageService) {
        $this->documentStorageRepository = $documentStorageRepository;
        $this->documentStorageService = $documentStorageService;
    }

    /**
     * Upload multiple file
     * 
     * @param DocumentStorageUploadRequest $request
     * @return
     */
    public function uploadMutilple(DocumentStorageUploadRequest $request) {
         return $this->documentStorageService->uploadMultipleFile($request);
    }

    /**
     * Upload multiple hình ảnh
     * 
     * @param ImageUploadMultipleRequest $request
     * @return
     */
    public function uploadMutilpleHinhAnh(ImageUploadMultipleRequest $request) {
        return $this->documentStorageService->uploadMultipleHinhAnh($request);
   }
   
   /**
     * Upload multiple video
     * 
     * @param VideoUploadMultipleRequest $request
     * @return
     */
    public function uploadMutilpleVideo(VideoUploadMultipleRequest $request) {
        return $this->documentStorageService->uploadMultipleVideo($request);
   }
   
   /**
     * Get document storages
     * 
     * @param DocumentStoragesRequest $request
     * @return
     */
    public function getListFileDinhKem(DocumentStoragesRequest $request) {
        return $this->documentStorageService->getListFileDinhKem($request);
    }

    public function downloadFileDinhKems(DocumentStoragesRequest $request) {
        return $this->documentStorageService->downloadFileDinhKems($request);
    }

    public function updateChiTietFileDinhKem($ID, FileUpdateDetailRequest $request) {
        return $this->documentStorageService->updateChiTietFileDinhKem($ID, $request);
    }
    
    public function updateChiTietHinhAnh($ID, ImageUpdateDetailRequest $request) {
        return $this->documentStorageService->updateChiTietHinhAnh($ID, $request);
    }

    public function cropHinhAnh($ID, ImageCropRequest $request) {
        return $this->documentStorageService->cropHinhAnh($ID, $request);
    }

    public function cropHinhAnhDaiDienVideo($ID, ImageCropRequest $request) {
        return $this->documentStorageService->cropHinhAnhDaiDienVideo($ID, $request);
    }

    public function updateChiTietVideo($ID, VideoUpdateDetailRequest $request) {
        return $this->documentStorageService->updateChiTietVideo($ID, $request);
    }

}
