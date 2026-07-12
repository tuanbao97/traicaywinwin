<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\transaction\TransactionDetailRequest;
use App\Http\Requests\transaction\TransactionListRequest;
use App\Http\Requests\transaction\TransactionPlaceOrderRequest;
use App\Http\Requests\transaction\TransactionUpdateStatusRequest;
use App\Service\TransactionService;

class TransactionController extends Controller
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function getListTransaction(TransactionListRequest $request)
    {
        return $this->transactionService->getListTransaction($request);
    }

    public function getDetailTransaction($ID, TransactionDetailRequest $request)
    {
        return $this->transactionService->getDetailTransaction($ID, $request);
    }

    public function updateTransactionStatus($ID, TransactionUpdateStatusRequest $request)
    {
        return $this->transactionService->updateTransactionStatus($ID, $request);
    }

    public function placeOrder(TransactionPlaceOrderRequest $request)
    {
        return $this->transactionService->placeOrder($request);
    }
}
