<?php

namespace App\Service\impl;

use App\Dto\product\ProductDetailDto;
use App\Dto\response\ApiResponseDto;
use App\Enum\AppConstant;
use App\Exceptions\BadRequestException;
use App\Exceptions\InternalServerErrorException;
use App\Exceptions\NotFoundException;
use App\Http\Requests\documentStorage\DocumentStorageUploadRequest;
use App\Http\Requests\documentStorage\DocumentStoragesRequest;
use App\Http\Requests\documentStorage\ImageUploadMultipleRequest;
use App\Http\Requests\documentStorage\VideoUploadMultipleRequest;
use App\Mapper\DocumentStorageMapper;
use App\Models\DocumentStorage;
use App\Repository\DocumentStorageRepository;
use App\Service\AppService;
use App\Service\DocumentStorageService;
use App\Service\FFMpegService;
use App\Service\InterventionImageService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use ZipArchive;
use Symfony\Component\HttpFoundation\File\File as FileSymfony;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class DocumentStorageServiceImpl implements DocumentStorageService
{
    // Inject bean
    private AppService $appService;
    private DocumentStorageRepository $documentStorageRepository;
    private InterventionImageService $interventionImage;
    private FFMpegService $ffMpegService;

    public function __construct(AppService $appService, DocumentStorageRepository $documentStorageRepository, InterventionImageService $interventionImage
        , FFMpegService $ffMpegService)
    {
        $this->appService = $appService;
        $this->documentStorageRepository = $documentStorageRepository;
        $this->interventionImage = $interventionImage;
        $this->ffMpegService = $ffMpegService;
    }

    /**
     * Upload multiple file
     *
     * @param DocumentStorageUploadRequest $request
     */
    public function uploadMultipleFile(Request $request)
    {
        if (!$request->hasFile('FILES')) {
            // Trả về lỗi nếu không có file được gửi lên
            $errors = [];
            throw new BadRequestException($errors, 'No file uploaded');
        }

        // Bắt đầu một transaction
        DB::beginTransaction();
        try {
            // Kiểm tra xem file đã được gửi lên chưa
            $arrUploadDS = [];
            $files = $request->file('FILES');
            
            // Thông tin directory.
            $directoryPath = $this->appService->getCurrDirectory();

            // Kiểm tra xem thư mục đã tồn tại hay chưa
            if (!File::isDirectory($directoryPath)) {
                // Nếu thư mục không tồn tại, tạo mới thư mục
                File::makeDirectory($directoryPath, 0777, true, true);
            }
            
            foreach ($files as $file) {
                $fileNameHash = $file->hashName();
                
                // Lưu vào database
                $documentStorage = self::saveFileDinhKem($file, $fileNameHash, $directoryPath);
               
                // Lưu vào ổ đĩa
                $file = self::storgeFileDinhKem($file, $fileNameHash, $directoryPath);
                
                // Lưu vào array output
                $arrUploadDS[] = $documentStorage;
            }
            
            // Nếu mọi thứ thành công, commit transaction
            DB::commit();
            
            // Trả về danh sách document storage
            return response()->json(
                new ApiResponseDto(AppConstant::STATUS_SUCCESS
                    ,'Upload thành công.'
                    , [
                        class_basename(DocumentStorage::class) => $arrUploadDS
                    ]
                )
            )->setStatusCode(JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollBack();
            $errors = [
                'MSG' => $e->getMessage()
            ];
            throw new InternalServerErrorException($errors, 'Lỗi xử lý file upload');
        }
    }

    /**
     * Upload hình ảnh và nén ảnh với chất lượng thấp hơn
     */
    public function uploadMultipleHinhAnh(ImageUploadMultipleRequest $request) {
        if (!$request->hasFile('FILES')) {
            // Trả về lỗi nếu không có file được gửi lên
            $errors = [];
            throw new BadRequestException($errors, 'No file uploaded');
        }

        // Bắt đầu một transaction
        DB::beginTransaction();
        try {
            // Kiểm tra xem file đã được gửi lên chưa
            $arrUploadDS = [];
            $files = $request->file('FILES');
            
            // Thông tin directory.
            $directoryPath = $this->appService->getCurrDirectory();
            
            // Kiểm tra xem thư mục đã tồn tại hay chưa
            if (!File::isDirectory($directoryPath)) {
                // Nếu thư mục không tồn tại, tạo mới thư mục
                File::makeDirectory($directoryPath, 0777, true, true);
            }

            foreach ($files as $file) {
                $fileNameHash = $file->hashName();
                
                // Lưu vào database
                $documentStorage = self::saveFileDinhKem($file, $fileNameHash, $directoryPath);
                
                // Lưu vào ổ đĩa
                // $file = self::storgeFileDinhKem($file, $fileNameHash, $directoryPath);
                
                // Đọc thông số hình ảnh qua Intervention Image
                $interventionImage = $this->interventionImage
                ->readImage($file->getRealPath());
                
                // RAW - Tạo và lưu ảnh với kích thước gốc với chất lượng từ config
                $interventionImage
                    ->readImage($file->getRealPath())
                    ->setFileName($fileNameHash)
                    ->setDestPath(public_path("{$directoryPath}"))
                    ->storeImg(chatLuongHinhAnh: config('app.image_quality')); // Đọc từ .env


                $danhSachKichThuocHinhAnh = $request->input('DANH_SACH_KICH_THUOC_HINH_ANH', default: array());
                foreach ($danhSachKichThuocHinhAnh as $index => $kichThuoc) {
                    // Resize hình ảnh theo kích thước
                    self::resizeImgTheoKichThuoc($kichThuoc, $interventionImage, $fileNameHash
                        , $directoryPath);
                }

                /*
                // Xóa hình ảnh gốc
                unlink($file->getRealPath()); 
                */
                
                // Lưu vào array output
                $arrUploadDS[] = $documentStorage;
            }
            
            // Nếu mọi thứ thành công, commit transaction
            DB::commit();
            
            // Trả về danh sách document storage
            return response()->json(
                new ApiResponseDto(AppConstant::STATUS_SUCCESS
                    ,'Upload thành công.'
                    , [
                        class_basename(DocumentStorage::class) => $arrUploadDS
                    ]
                )
            )->setStatusCode(JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            // Rollback transaction
            DB::rollBack();
            $errors = [
                'MSG' => $e->getMessage()
            ];
            throw new InternalServerErrorException($errors, 'Lỗi xử lý file upload');
        }
    }

    /**
     * Upload multiple video vàn nén chất lượng thấp hơn
     */
    public function uploadMultipleVideo(VideoUploadMultipleRequest $request) {
        if (!$request->hasFile('VIDEOS')) {
            // Trả về lỗi nếu không có file được gửi lên
            $errors = [];
            throw new BadRequestException($errors, 'No video uploaded');
        }
        
        // Bắt đầu một transaction
        DB::beginTransaction();
        try {
            $videos = $request->file('VIDEOS');
            $kichThuocHinhAnhDaiDien = $request->input('KICH_THUOC_HINH_ANH_DAI_DIEN', 'RAW');
            $arrUploadDS = [];

            // Thông tin directory.
            $directoryPath = $this->appService->getCurrDirectory();
            
            // Kiểm tra xem thư mục đã tồn tại hay chưa
            if (!File::isDirectory($directoryPath)) {
                // Nếu thư mục không tồn tại, tạo mới thư mục
                File::makeDirectory($directoryPath, 0777, true, true);
            }
            
            foreach ($videos as $index => $video) {
                $fileNameHash = $video->hashName();
                $fileNameHashWithoutExtension = pathinfo($fileNameHash, PATHINFO_FILENAME);
                $fileOriginalNameWithoutExtension = pathinfo($video->getClientOriginalName(), PATHINFO_FILENAME);
                $fileNameImgThumnail = $fileNameHashWithoutExtension . '.png'; // Dùng pathinfo để chỉ lấy file name không lấy extension
                
                // Lưu vào database
                $documentStorage = self::saveFileDinhKem($video, $fileNameHash, $directoryPath);
                // Cập nhật thông tin hình ảnh
                $documentStorage->ORIGINAL_NAME = $fileOriginalNameWithoutExtension . '.mp4';
                $documentStorage->TYPE_FILE = 'video/mp4';
                $documentStorage->EXTENSION = 'mp4';
                $documentStorage->ATTR1 = $fileNameImgThumnail;
                $documentStorage->save();
                
                 // Storage video đã nén vào ổ đĩa
                $this->ffMpegService
                     ->openVideo($video->getRealPath())
                     ->formatVideoMp4()
                     ->convertVideoToResolutionHD()
                     ->generateImageThumnail(5, $directoryPath, $fileNameImgThumnail) // Tạo ảnh đại diện cho video. Từ giây thứ 5 thì screenshot
                     ->saveVideo($directoryPath, $fileNameHash);

                // Tạo ảnh thumnail 3x2
                 // Đọc thông số hình ảnh qua Intervention Image
                $interventionImage = $this->interventionImage->readImage(realpath($directoryPath . '/' .$fileNameImgThumnail));
               
                // Resize hình ảnh theo kích thước
                self::resizeImgTheoKichThuoc($kichThuocHinhAnhDaiDien, $interventionImage, $fileNameImgThumnail, $directoryPath);

                // Crop hình ảnh
                /* 
                $kichThuoc = '3x2';
                $chieuRong = 700;
                $chatLuongAnh = 70;
                $chieuCao = strtolower($kichThuoc) === 'raw' ? $interventionImage->getImageInterface()->height() : $chieuRong * self::getTiLeKichThuoc($kichThuoc);

                $fileName = strtolower($kichThuoc) === 'raw' ? $fileNameHash : $kichThuoc . '_' . $fileNameImgThumnail;
                
                // Tạo và lưu ảnh với kích thước tương ứng và độ phân giải 70% so với ban đầu
                $interventionImage
                ->setFileName($fileName)
                ->setDestPath(public_path("{$directoryPath}"))
                ->crop($chieuRong, $chieuCao, $interventionImage->getImageInterface()->width() / 2, $interventionImage->getImageInterface()->height() / 2)
                ->storeImg(chatLuongHinhAnh: $chatLuongAnh); // Giới hạn 70% độ phân giải 
                */
                
                // Lưu vào array output
                $videoDetailDto = DocumentStorageMapper::mapVideoDetailFromEntity($documentStorage);
                $arrUploadDS[] = $videoDetailDto;
            }

            // Nếu mọi thứ thành công, commit transaction
            DB::commit();
            
             // Trả về danh sách document storage
            return response()->json(
                    new ApiResponseDto(AppConstant::STATUS_SUCCESS
                    , 'Upload thành công.'
                    , [
                        class_basename(DocumentStorage::class) => $arrUploadDS
                    ]
                )
            )->setStatusCode(JsonResponse::HTTP_OK);
        } catch (\Throwable $e) {
            // Rollback transaction
            DB::rollBack();
            $errors = [
                'MSG' => $e->getMessage()
            ];
            throw new InternalServerErrorException($errors, 'Lỗi xử lý video upload');
        }
    }
    public function resizeImgTheoKichThuoc(string $kichThuoc, InterventionImageService $interventionImage, string $fileNameHash, string $directoryPath
        , int $chieuRong = 700, int $chatLuongAnh = null) {
        // Nếu không truyền $chatLuongAnh, đọc từ config
        $chatLuongAnh = $chatLuongAnh ?? config('app.image_quality');
        if (blank($kichThuoc)) return;

        $chieuCao = strtolower($kichThuoc) === 'raw' 
            ? $interventionImage->getImageInterface()->height() : $chieuRong * self::getTiLeKichThuoc($kichThuoc);

        $fileName = strtolower($kichThuoc) === 'raw' ? $fileNameHash : $kichThuoc . '_' . $fileNameHash;

        // Kiểm tra xem thư mục đã tồn tại hay chưa
        if (!File::isDirectory($directoryPath)) {
            // Nếu thư mục không tồn tại, tạo mới thư mục
            File::makeDirectory($directoryPath, 0777, true, true);
        }
        
        // Tạo và lưu ảnh với kích thước tương ứng và chất lượng từ config
        $interventionImage
        ->setFileName($fileName)
        ->setDestPath(public_path("{$directoryPath}"))
        ->resize($chieuRong, $chieuCao)
        ->storeImg(chatLuongHinhAnh: $chatLuongAnh); // Đọc từ config
    }
    
    public function getTiLeKichThuoc(string $kichThuoc = "3x2"): float {
        $tiLeKichThuoc = 0;

        switch ($kichThuoc) {
            case '1x1':
                $tiLeKichThuoc = 1;
                break;
            case '3x2':
                $tiLeKichThuoc = 2/3;
                break;
            case '4x3':
                $tiLeKichThuoc = 3/4;
                break;
            case '16x9':
                $tiLeKichThuoc = 9/16;
                break;
            case '5x3': // Mặc định tỉ lệ 5x3
            default:
                $tiLeKichThuoc = 3/5;
                break;
        }
        return $tiLeKichThuoc;
    }

    /**
     * Lưu trữ file vào thư mục dưj án
     *
     * @param UploadedFile $file
     * @param $fileNameHash
     * @param $directoryPath
     */
    public function storgeFileDinhKem(UploadedFile $file, $fileNameHash, $directoryPath) : FileSymfony
    {
        return $file->move($directoryPath, $fileNameHash);
    }

    /**
     * Lưu model document storage vào database
     * 
     * @param UploadedFile $file
     * @param string $fileNameHash
     * @param string $directoryPath
     * @param string $description
     * @return DocumentStorage
     */
    public function saveFileDinhKem(UploadedFile $file, string $fileNameHash, string $directoryPath, string $description = null) : DocumentStorage {
        $data = [];
        $data['ID'] = null;
        $data['FILE_NAME_HASH'] = $fileNameHash;
        $data['FILE_ORIGINAL_NAME'] = $file->getClientOriginalName();
        $data['FILE_EXTENSION'] = $file->getClientOriginalExtension();
        $data['FILE_PATH'] = $directoryPath . '/' . $fileNameHash;
        $data['FILE_DIRECTORY'] = $directoryPath;
        $data['FILE_SIZE'] = $file->getSize();
        $data['TYPE_FILE'] = $file->getClientMimeType();
        $data['DESCRIPTION'] = $description;

        $documentStorage = new DocumentStorage();
        DocumentStorageMapper::mapFromArray($documentStorage, $data);
        
        // Lưu vào database
        $documentStorage->save();
        return $documentStorage;
    }

    /**
     * Get danh sách document storage
     *
     * @param DocumentStoragesRequest $request
     */
    public function getListFileDinhKem(Request $request)
    {
        $ids = $request->input('IDS', []);
        $names = $request->input('NAMES', []);
        $documentStorages = $this->documentStorageRepository->getListFileDinhKemAndStatus($ids, $names, AppConstant::STATUS_USING);
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                ,'Truy vấn thành công.'
                , [
                    class_basename(DocumentStorage::class) => $documentStorages
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    /**
     * Get document storage theo id
     *
     * @param int $id
     * @param $status
     * @return DocumentStorage
     */
    public function getFileDinhKemById(int $id, $status): ?DocumentStorage
    {
        $documentStorage = $this->documentStorageRepository->getFileDinhKemByIdAndStatus($id, $status);
        return $documentStorage;
    }

    /**
     * Download danh sách document storage
     *
     * @param DocumentStoragesRequest $request
     */
    public function downloadFileDinhKems(Request $request)
    {
        $ids = $request->input('IDS', []);
        $names = $request->input('NAMES', []);
        $documentStorages = $this->documentStorageRepository->getListFileDinhKemAndStatus($ids, $names, AppConstant::STATUS_USING);

        if ($documentStorages->isEmpty()) {
            // Trả về lỗi nếu không tìm thấy files
            $errors = [];
            throw new BadRequestException($errors, 'Không tìm thấy files.');
        } else {
            if ($documentStorages->count() == 1) { // Nếu chỉ có 1 file thì sẽ download trực tiếp luôn
                $filePath = $documentStorages->get(0)->PATH ?? '';
                $fileName = $documentStorages->get(0)->ORIGINAL_NAME;
                return self::downloadFileDinhKem($filePath, $fileName);
            } else { // Nếu >= 2 file trở lên thì zip lại và download
                return self::downloadZipFileDinhKem($documentStorages, 'TEP_TIN' . '.zip');
            }
        }
    }

    /**
     * Download file
     *
     * @param string $filePath
     * @param string $fileName
     */
    public function downloadFileDinhKem($filePath, $fileName) {
        // Nếu file không tồn tại thì throw exception
        if (!File::exists($filePath)) {
            $errors = [];
            throw new NotFoundException($errors, 'Không tìm thấy files.');
        }
        $fileNameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileName = $fileNameWithoutExtension . '.' . $extension;
        return response()->download($filePath, $fileName);
    }

    /**
     * Download danh sách file và zip lại
     *
     * @param $documentStorages
     * @param string $zipFileName
     */
    public function downloadZipFileDinhKem($documentStorages, $zipFileName) {
        if (isset($documentStorages) && $documentStorages->count() == 0) {
            throw new BadRequestException([], 'Không tìm thấy files.');
        }
        
        // Kiểm tra xem thư mục đã tồn tại hay chưa
        $path = $this->appService->getCurrDirectory();
        if (!File::isDirectory($path)) {
            // Nếu thư mục không tồn tại, tạo mới thư mục
            File::makeDirectory($path, 0777, true, true);
        }
   
        // Tạo file zip
        $zipFile = $path . '/' . $zipFileName;
        $zip = new ZipArchive;
        if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($documentStorages as $index => $documentStorage) {
                $filePath = $documentStorage->PATH ?? '';
                $fileName = $documentStorage->ORIGINAL_NAME;
                if (File::exists($filePath)) {
                    $zip->addFile($filePath, $fileName);
                }
            }
            $numFileZiped = $zip->numFiles;
            $zip->close();

            // Nếu file không tồn tại thì throw exception
            if ($numFileZiped == 0) {
                $errors = [];
                throw new NotFoundException($errors, 'Không tìm thấy files.');
            }
            return response()->download($zipFile)->deleteFileAfterSend(true);
        } else {
            return response()->json(['error' => 'Không tạo được tệp ZIP.'], 500);
        }
    }

    /**
     * Update chi tiết hình ảnh
     * 
     * @param $id
     * @param Request $request
     */
    public function updateChiTietFileDinhKem($id, Request $request) {
        // Bắt đầu một transaction
        DB::beginTransaction();

        // Get chi tiết hình ảnh
        $documentStorage = self::getFileDinhKemById($id, AppConstant::STATUS_USING);

        // Cập nhật thông tin hình ảnh
        $documentStorage->ORIGINAL_NAME = $request->input('TEN_FILE_DINH_KEM');
        $documentStorage->DESCRIPTION = $request->input('MO_TA');
        $documentStorage->save();

        // Mapper to Dto
        $documentStorageDetailDto = DocumentStorageMapper::mapDocumentStorageDetailFromEntity($documentStorage);

        // Nếu mọi thứ thành công, commit transaction
        DB::commit();

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Cập nhật thành công.'
                , [
                    camelToSnakeUpper(class_basename(DocumentStorage::class)) => $documentStorageDetailDto
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }
    
    /**
     * Update chi tiết hình ảnh
     * 
     * @param $id
     * @param Request $request
     */
    public function updateChiTietHinhAnh($id, Request $request) {
        // Bắt đầu một transaction
        DB::beginTransaction();

        // Get chi tiết hình ảnh
        $documentStorage = self::getFileDinhKemById($id, AppConstant::STATUS_USING);

        // Cập nhật thông tin hình ảnh
        $documentStorage->ORIGINAL_NAME = $request->input('TEN_HINH_ANH');
        $documentStorage->DESCRIPTION = $request->input('MO_TA');
        $documentStorage->save();

        // Mapper to Dto
        $documentStorageDetailDto = DocumentStorageMapper::mapDocumentStorageDetailFromEntity($documentStorage);

        // Nếu mọi thứ thành công, commit transaction
        DB::commit();

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Cập nhật thành công.'
                , [
                    camelToSnakeUpper(class_basename(DocumentStorage::class)) => $documentStorageDetailDto
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    /**
     * Lưu ảnh đã crop
     * 
     * @param $id
     * @param Request $request
     */
    public function cropHinhAnh($id, Request $request) {
        // Bắt đầu một transaction
        DB::beginTransaction();
        try {
            // Kiểm tra xem file đã được gửi lên chưa
            $file = $request->file('FILE');
            
            // Get kích thước crop hình ảnh
            $kichThuocAnh = $request->input('KICH_THUOC_HINH_ANH', null);
            if (!isset($kichThuocAnh)) return;
        
            // Get chi tiết hình ảnh
            $documentStorage = self::getFileDinhKemById($id, AppConstant::STATUS_USING);
            
            // Thông tin directory.
            $filePath = null;
            if (strtolower($kichThuocAnh) === 'raw') {
                $filePath = $documentStorage->DIRECTORY . '/' . $documentStorage->NAME ?? '';
            } else {
                $filePath = $documentStorage->DIRECTORY . '/' . $kichThuocAnh . '_' . $documentStorage->NAME ?? '';
            }
            
            // Nếu file không tồn tại thì throw exception
            /* 
            if (!File::exists($filePath)) {
                $errors = [];
                throw new NotFoundException($errors, 'Không tìm thấy files.');
            } 
            */

            // Xóa hình ảnh crop tương ứng trước đó
            File::delete($filePath);
            
            // Lưu vào ổ đĩa
            // $file = self::storgeFileDinhKem($file, $kichThuocAnh . '_' . $documentStorage->NAME, $documentStorage->DIRECTORY);
            $documentStorage->UPD_DT = Carbon::now();
            $documentStorage->save();
            
            // Đọc thông số hình ảnh qua Intervention Image
            $interventionImage = $this->interventionImage
                                      ->readImage($file->getRealPath());
            
            if (strtolower($kichThuocAnh) === 'raw') {
                // Kích thước ảnh crop gốc
                self::resizeImgTheoKichThuoc($kichThuocAnh, $interventionImage, $documentStorage->NAME
                    , $documentStorage->DIRECTORY, $interventionImage->getImageInterface()->width());
            } else {
                // Kích thước crop
                self::resizeImgTheoKichThuoc($kichThuocAnh, $interventionImage, $documentStorage->NAME
                , $documentStorage->DIRECTORY);
            }
            
            // Nếu mọi thứ thành công, commit transaction
            DB::commit();
            
            // Trả về danh sách document storage
            return response()->json(
                new ApiResponseDto(AppConstant::STATUS_SUCCESS
                    ,'Upload thành công.'
                    , [
                        class_basename(DocumentStorage::class) => $documentStorage
                    ]
                )
            )->setStatusCode(JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollBack();
            $errors = [
                'MSG' => $e->getMessage()
            ];
            throw new InternalServerErrorException($errors, 'Lỗi xử lý file upload');
        }
    }

     /**
     * Lưu ảnh đại diện video đã crop
     * 
     * @param $id
     * @param Request $request
     */
    public function cropHinhAnhDaiDienVideo($id, Request $request) {
        // Bắt đầu một transaction
        DB::beginTransaction();
        try {
            // Kiểm tra xem file đã được gửi lên chưa
            $file = $request->file('FILE');
            
            // Get kích thước crop hình ảnh
            $kichThuocAnh = $request->input('KICH_THUOC_HINH_ANH', null);
            if (!isset($kichThuocAnh)) return;
        
            // Get chi tiết hình ảnh
            $documentStorage = self::getFileDinhKemById($id, AppConstant::STATUS_USING);
            
            // Thông tin directory.
            $filePath = null;
            if (strtolower($kichThuocAnh) === 'raw') {
                $filePath = $documentStorage->DIRECTORY . '/' . $documentStorage->ATTR1 ?? '';
            } else {
                $filePath = $documentStorage->DIRECTORY . '/' . $kichThuocAnh . '_' . $documentStorage->ATTR1 ?? '';
            }
            
            // Nếu file không tồn tại thì throw exception
            /* 
            if (!File::exists($filePath)) {
                $errors = [];
                throw new NotFoundException($errors, 'Không tìm thấy files.');
            } 
            */

            // Xóa hình ảnh crop tương ứng trước đó
            File::delete($filePath);
            
            // Lưu vào ổ đĩa
            // $file = self::storgeFileDinhKem($file, $kichThuocAnh . '_' . $documentStorage->ATTR1, $documentStorage->DIRECTORY);
            
            // Đọc thông số hình ảnh qua Intervention Image
            $interventionImage = $this->interventionImage
                                      ->readImage($file->getRealPath());
            
            if (strtolower($kichThuocAnh) === 'raw') {
                // Kích thước ảnh crop gốc
                self::resizeImgTheoKichThuoc($kichThuocAnh, $interventionImage, $documentStorage->ATTR1
                    , $documentStorage->DIRECTORY, $interventionImage->getImageInterface()->width());
            } else {
                // Kích thước crop
                self::resizeImgTheoKichThuoc($kichThuocAnh, $interventionImage, $documentStorage->ATTR1
                , $documentStorage->DIRECTORY);
            }
            
            // Nếu mọi thứ thành công, commit transaction
            DB::commit();

            // Trả về danh sách document storage
            return response()->json(
                new ApiResponseDto(AppConstant::STATUS_SUCCESS
                    ,'Upload thành công.'
                    , [
                        class_basename(DocumentStorage::class) => DocumentStorageMapper::mapVideoDetailFromEntity($documentStorage)
                    ]
                )
            )->setStatusCode(JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollBack();
            $errors = [
                'MSG' => $e->getMessage()
            ];
            throw new InternalServerErrorException($errors, 'Lỗi xử lý file upload');
        }

    }

    /**
     * Update chi tiết video
     * 
     * @param $id
     * @param Request $request
     */
    public function updateChiTietVideo($id, Request $request) {
        // Bắt đầu một transaction
        DB::beginTransaction();

        // Get chi tiết hình ảnh
        $documentStorage = self::getFileDinhKemById($id, AppConstant::STATUS_USING);

        // Cập nhật thông tin hình ảnh
        $documentStorage->ORIGINAL_NAME = $request->input('TEN_VIDEO');
        $documentStorage->DESCRIPTION = $request->input('MO_TA');
        $documentStorage->save();

        // Mapper to Dto
        $documentStorageDetailDto = DocumentStorageMapper::mapVideoDetailFromEntity($documentStorage);

        // Nếu mọi thứ thành công, commit transaction
        DB::commit();

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Cập nhật thành công.'
                , [
                    camelToSnakeUpper(class_basename(DocumentStorage::class)) => $documentStorageDetailDto
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }



}

