<?php

namespace App\Service\impl;

use App\Dto\response\ApiResponseDto;
use App\Enum\AppConstant;
use App\Exceptions\InternalServerErrorException;
use App\Mapper\ProvinceMapper;
use App\Models\Province;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Service\ProvinceService;
use App\Repository\ProvinceRepository;
use App\Repository\DistrictRepository;
use App\Repository\WardRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinceServiceImpl implements ProvinceService
{
    // Inject beans
    private ProvinceRepository $provinceRepository;
    private DistrictRepository $districtRepository;
    private WardRepository $wardRepository;
    
    /**
     * Create a new class instance.
     */
    public function __construct(ProvinceRepository $provinceRepository, DistrictRepository $districtRepository, WardRepository $wardRepository)
    {
        $this->provinceRepository = $provinceRepository;
        $this->districtRepository = $districtRepository;
        $this->wardRepository = $wardRepository;
    }

    public function importDataTinhThanhVietNam(Request $request)
    {
        // Bắt đầu một Transaction
        DB::beginTransaction();
        try {
            // Kiểm tra xem file đã được gửi lên chưa
            $file = $request->file('FILE');
            $filePath = null;
            if (is_null($file)) {
                // Nếu không có file upload, dùng file có sẵn trong thư mục public
                $filePath = public_path('Danh sách cấp tỉnh kèm theo quận huyện, phường xã ___28_07_2024.xls');
            } else {
                // Nếu có file upload, lưu tạm file vào thư mục tạm và lấy đường dẫn
                // Laravel sẽ tự động xóa file tạm sau khi request kết thúc
                $filePath = $file->getRealPath();
            }

            // Load Excel file
            $spreadSheet = IOFactory::load($filePath);

            // Get the active sheet
            $sheet = $spreadSheet->getSheetByName("Sheet1");

            if (!isset($sheet)) {
                return;
            }

            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            
            // Looping rows
            $tinhTPCollct = collect([]);
            $quanHuyenCollct = collect(array());
            $phuongXaCollct = collect([]);
            for ($row = 2; $row <= $highestRow; $row++) {
                $maTP = $sheet->getCell('B' . $row)->getValue() ?: '';
                $tinhTP = $sheet->getCell('A' . $row)->getValue() ?: '';
                $sttTinhTP = $sheet->getCell('I' . $row)->getValue() ?: null;

                // Collection Tỉnh và thành phố
                if (!$tinhTPCollct->has(trim($maTP))) {
                    $objTinhTP = new \stdClass();
                    $objTinhTP->tinhTP = trim($tinhTP);
                    $objTinhTP->sttTinhTP = $sttTinhTP;
                    $tinhTPCollct->put(trim($maTP), $objTinhTP);
                }

                // Collection Quận Huyện
                $maQH = $sheet->getCell('D' . $row)->getValue() ?: '';
                $quanHuyen = $sheet->getCell('C' . $row)->getValue() ?: '';
                $sttQuanHuyen = $sheet->getCell('J' . $row)->getValue() ?: null;
                if (!$quanHuyenCollct->has(trim($maQH))) {
                    $objQuanHuyen = new \stdClass();
                    $objQuanHuyen->maTP = $maTP;
                    $objQuanHuyen->tinhTP = $tinhTP;
                    $objQuanHuyen->quanHuyen = $quanHuyen;
                    $objQuanHuyen->sttQuanHuyen = $sttQuanHuyen;
                    
                    $quanHuyenCollct->put(trim($maQH), $objQuanHuyen);
                }

                // Collection Phường Xã
                $maPX = $sheet->getCell('F' . $row)->getValue() ?: '';
                $phuongXa = $sheet->getCell('E' . $row)->getValue() ?: '';
                $capPX = $sheet->getCell('G' . $row)->getValue() ?: '';
                $sttPhuongXa = $sheet->getCell('K' . $row)->getValue() ?: null;
                if (!$phuongXaCollct->has(trim($maPX))) {
                    $objPX = new \stdClass();
                    $objPX->maTP = $maTP;
                    $objPX->tinhTP = $tinhTP;
                    $objPX->maQH = $maQH;
                    $objPX->quanHuyen = $quanHuyen;
                    $objPX->phuongXa = $phuongXa;
                    $objPX->capPX = $capPX;
                    $objPX->sttPhuongXa = $sttPhuongXa;

                    $phuongXaCollct->put(trim($maPX), $objPX);
                }
            }
            set_time_limit(10 * 60); // Tối đa timeout 10 phút
            // Save Tỉnh Thành phố
            $this->provinceRepository->saveProvinces($tinhTPCollct);
            // Save Quận Huyện
            $this->districtRepository->saveQuanHuyen($quanHuyenCollct);
            // Save Phường Xã Thị Trấn
            $this->wardRepository->saveWards($phuongXaCollct);

            DB::commit();
            return response()->json(
                new ApiResponseDto(AppConstant::STATUS_SUCCESS
                    , 'Import thông tin Tỉnh Thành thành công.'
                    , [
                        camelToSnakeUpper(class_basename(Province::class)) => null
                    ]
                )
            )->setStatusCode(JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            //throw $th;
            // Rollback transaction
            DB::rollBack();
            $errors = [
                'MSG' => $th->getMessage()
            ];
            throw new InternalServerErrorException($errors, 'Lỗi xử lý file upload');
        }
    }

    public function getListTinhThanh(Request $request)
    {
        $result = $this->provinceRepository->getListTinhThanh(null);
        $resultDto = ProvinceMapper::maplistProvinceDto($result);

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Truy vấn thành công.'
                , [
                    class_basename(Province::class) . '_total' => $resultDto->count(),
                    class_basename(Province::class) => $resultDto
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

}
