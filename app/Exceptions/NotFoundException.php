<?php

namespace App\Exceptions;

use App\Enum\AppConstant;
use Illuminate\Http\JsonResponse;
use Exception;

class NotFoundException extends Exception
{
    private $errors;

    private $statusDetail;

    public function __construct($errors, $statusDetail = null)
    {
       $this->errors = $errors;
       $this->statusDetail = $statusDetail;
       $this->code = JsonResponse::HTTP_NOT_FOUND;
    }

    public function render($request) {
        return response()->json([
            'ERRORS' => $this->errors,
            'STATUS' => AppConstant::STATUS_FAILURE,
            'CODE' => $this->code,
            'STATUS_DETAIL' => is_null($this->statusDetail) ? AppConstant::STATUS_DETAIL_FAILURE : $this->statusDetail
        ], $this->code);
    }

}
