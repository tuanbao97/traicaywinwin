<?php

namespace App\Service;

use Illuminate\Http\Request;

interface TransactionService
{
    public function getListTransaction(Request $request);

    public function getDetailTransaction($id, Request $request);

    public function updateTransactionStatus($id, Request $request);

    public function placeOrder(Request $request);
}
