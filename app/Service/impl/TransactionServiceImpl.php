<?php

namespace App\Service\impl;

use App\Dto\response\ApiResponseDto;
use App\Enum\AppConstant;
use App\Enum\AuthConstant;
use App\Enum\TransactionStatusEnum;
use App\Mapper\TransactionMapper;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Repository\TransactionRepository;
use App\Service\TransactionService;
use App\Utils\PaginationUtils;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionServiceImpl implements TransactionService
{
    private const CART_SESSION_KEY = 'theme_storefront_cart';

    private TransactionRepository $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function getListTransaction(Request $request)
    {
        $draw = $request->input('DRAW', 1);
        $page = (int) $request->query('PAGE', 1);
        $perPage = (int) $request->query('PER_PAGE', 10);
        $isGetAllElements = filter_var($request->query('IS_GET_ALL_ELEMENTS', false), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        if ($isGetAllElements === true) {
            $perPage = 2147483647;
        }

        $tuKhoa = $request->input('TU_KHOA', null);
        $trangThaiGiaoDich = $request->input('TRANG_THAI_GIAO_DICH', null);

        $resultPagination = $this->transactionRepository->getList(
            $tuKhoa,
            $trangThaiGiaoDich,
            $page,
            $perPage
        );

        $listTransactionDto = TransactionMapper::mapListFromPaginator($resultPagination->getCollection());
        $resultPagination->setCollection($listTransactionDto);
        $customResponsePagination = PaginationUtils::pagination($resultPagination);
        $customResponsePagination['DRAW'] = $draw;

        return response()->json(
            new ApiResponseDto(
                AppConstant::STATUS_SUCCESS,
                'Truy vấn thành công.',
                [
                    camelToSnakeUpper(class_basename(Transaction::class)) => $customResponsePagination,
                ],
                JsonResponse::HTTP_OK
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function getDetailTransaction($id, Request $request)
    {
        $transaction = $this->transactionRepository->getDetailWithItems((int) $id);
        $transactionDetail = null;
        if (! is_null($transaction)) {
            $transactionDetail = TransactionMapper::mapFromEntity($transaction, true);
        }

        return response()->json(
            new ApiResponseDto(
                AppConstant::STATUS_SUCCESS,
                'Truy vấn thành công.',
                [
                    camelToSnakeUpper(class_basename(Transaction::class)) => $transactionDetail,
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function updateTransactionStatus($id, Request $request)
    {
        DB::beginTransaction();

        $transaction = $this->transactionRepository->getDetail((int) $id);
        $transaction->TRANSACTION_STATUS = $request->input('TRANSACTION_STATUS');
        $this->setAuditFields($transaction, false);
        $transaction->save();

        DB::commit();

        return response()->json(
            new ApiResponseDto(
                AppConstant::STATUS_SUCCESS,
                'Cập nhật trạng thái thành công.',
                [
                    camelToSnakeUpper(class_basename(Transaction::class)) => TransactionMapper::mapFromEntity($transaction, false),
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function placeOrder(Request $request)
    {
        $items = $this->resolveOrderItems($request);
        $totalQuantity = 0;
        $totalPrice = 0;

        foreach ($items as $item) {
            $quantity = (float) ($item['QUANTITY'] ?? 0);
            $price = (float) ($item['PRICE'] ?? 0);
            $totalQuantity += $quantity;
            $totalPrice += $quantity * $price;
        }

        DB::beginTransaction();

        $user = Auth::user();
        $buyerName = $request->input('HO_TEN');
        $buyerPhone = $request->input('SO_DIEN_THOAI');
        $buyerEmail = $request->input('EMAIL');
        $buyerAddress = $request->input('DIA_CHI');
        $buyerNote = $request->input('GHI_CHU');

        $transaction = new Transaction();
        $transaction->USER_BUY_ID = $user?->ID;
        $transaction->USER_BUY_EMAIL = $buyerEmail;
        $transaction->USER_BUY_FULLNAME = $buyerName;
        $transaction->USER_BUY_PHONE = $buyerPhone;
        $transaction->USER_BUY_ADDRESS = $buyerAddress;
        $transaction->USER_BUY_MESSAGE = $buyerNote;
        $transaction->TOTAL_QUANTITY = $totalQuantity;
        $transaction->TOTAL_PRICE = $totalPrice;
        $transaction->TRANSACTION_STATUS = TransactionStatusEnum::PENDING->value;
        $transaction->PAYMENT_METHOD = $request->input('PHUONG_THUC_THANH_TOAN');
        $transaction->STATUS = AppConstant::STATUS_USING;
        $transaction->IS_ACTIVE = true;
        $this->setAuditFields($transaction, true, $buyerName);
        $transaction->save();

        foreach ($items as $item) {
            $orderItem = new OrderItem();
            $orderItem->TRANSACTION_ID = $transaction->ID;
            $orderItem->PRODUCT_ID = (int) ($item['PRODUCT_ID'] ?? 0);
            $orderItem->QUANTITY = (float) ($item['QUANTITY'] ?? 0);
            $orderItem->PRICE = (float) ($item['PRICE'] ?? 0);
            $orderItem->ATTR1 = $item['TEN_SAN_PHAM'] ?? null;
            $orderItem->ATTR2 = $item['HINH_ANH'] ?? null;
            $orderItem->ATTR3 = $item['HANDLE'] ?? null;
            $orderItem->STATUS = AppConstant::STATUS_USING;
            $orderItem->IS_ACTIVE = true;
            $this->setAuditFields($orderItem, true, $buyerName);
            $orderItem->save();
        }

        DB::commit();

        if ($request->hasSession() && $request->session()->has(self::CART_SESSION_KEY)) {
            $request->session()->forget(self::CART_SESSION_KEY);
        }

        return response()->json(
            new ApiResponseDto(
                AppConstant::STATUS_SUCCESS,
                'Đặt hàng thành công.',
                [
                    camelToSnakeUpper(class_basename(Transaction::class)) => [
                        'ID' => $transaction->ID,
                    ],
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function resolveOrderItems(Request $request): array
    {
        $items = $request->input('ITEMS');
        if (is_array($items) && count($items) > 0) {
            return array_values($items);
        }

        if (! $request->hasSession()) {
            return [];
        }

        $cartLines = $request->session()->get(self::CART_SESSION_KEY, []);
        if (! is_array($cartLines) || $cartLines === []) {
            return [];
        }

        return array_values(array_map(static function (array $line): array {
            return [
                'PRODUCT_ID' => (int) ($line['variant_id'] ?? $line['PRODUCT_ID'] ?? 0),
                'QUANTITY' => (float) ($line['quantity'] ?? $line['QUANTITY'] ?? 0),
                'PRICE' => (float) ($line['price'] ?? $line['PRICE'] ?? 0),
                'TEN_SAN_PHAM' => $line['title'] ?? $line['TEN_SAN_PHAM'] ?? null,
                'HINH_ANH' => $line['image'] ?? $line['HINH_ANH'] ?? null,
                'HANDLE' => $line['handle'] ?? $line['HANDLE'] ?? null,
            ];
        }, $cartLines));
    }

    private function setAuditFields(Transaction|OrderItem $model, bool $isCreate, ?string $buyerName = null): void
    {
        $user = Auth::user();
        $actorId = $user?->ID ?? AuthConstant::USER_SUPER_ADMIN_ID;
        $actorName = $user?->FULL_NAME ?? ($buyerName ?: AuthConstant::USER_SUPER_ADMIN_FULL_NAME);
        $now = Carbon::now();

        if ($isCreate) {
            $model->CRT_ID = $actorId;
            $model->CRT_NAME = $actorName;
            $model->CRT_DT = $now;
        }

        $model->UPD_ID = $actorId;
        $model->UPD_NAME = $actorName;
        $model->UPD_DT = $now;
    }
}
