<?php

namespace App\Dto\response;

use JsonSerializable;

class ApiResponseDto implements JsonSerializable
{
    public $status;
    public ?int $statusCode;
    public $statusDetail;
    public $datas;

    public function __construct($status, $statusDetail, $datas, ?int $statusCode = null) {
        $this->status = $status;
        $this->statusDetail = $statusDetail;
        $this->datas = $datas;
        $this->statusCode = $statusCode;
    }


    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getstatusDetail()
    {
        return $this->statusDetail;
    }

    /**
     * @return mixed
     */
    public function getDatas()
    {
        return $this->datas;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param mixed $statusDetail
     */
    public function setstatusDetail($statusDetail)
    {
        $this->statusDetail = $statusDetail;
    }

    /**
     * @param mixed $datas
     */
    public function setDatas($datas)
    {
        $this->datas = $datas;
    }

    public function jsonSerialize(): mixed {
        return [
            'STATUS' => $this->status
            , 'CODE' => $this->statusCode
            , 'STATUS_DETAIL' => $this->statusDetail
            , 'DATAS' => $this->datas
        ];
    }
    
}
