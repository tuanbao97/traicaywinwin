<?php

namespace App\Dto\address;

class AddressDetailDto implements \JsonSerializable
{
    public ?string $addressProvineCode;
    public ?string $addressProvineName;
    public ?string $addressDistrictCode;
    public ?string $addressDistrictName;
    public ?string $addressWardCode;
    public ?string $addressWardName;
    public ?string $addressRoadName;
    public ?string $addressNumber;
    public ?string $addressFullInfo;

    /**
     * Create a new class instance.
     */
    public function __construct(?string $addressProvineCode = null, ?string $addressProvineName = null
        , ?string $addressDistrictCode = null, ?string $addressDistrictName = null
        , ?string $addressWardCode = null, ?string $addressWardName = null
        , ?string $addressRoadName = null, ?string $addressNumber = null
        , ?string $addressFullInfo = null)
    {
        $this->addressProvineCode = $addressProvineCode;
        $this->addressProvineName = $addressProvineName;
        $this->addressDistrictCode = $addressDistrictCode;
        $this->addressDistrictName = $addressDistrictName;
        $this->addressWardCode = $addressWardCode;
        $this->addressWardName = $addressWardName;
        $this->addressRoadName = $addressRoadName;
        $this->addressNumber = $addressNumber;
        $this->addressFullInfo = $addressFullInfo;
    }

    public function jsonSerialize(): mixed {
        return [
            'ADDRESS_THANH_PHO_CODE' => $this->addressProvineCode
            , 'ADDRESS_THANH_PHO_NAME' => $this->addressProvineName
            , 'ADDRESS_QUAN_HUYEN_THI_XA_CODE' => $this->addressDistrictCode
            , 'ADDRESS_QUAN_HUYEN_THI_XA_NAME' => $this->addressDistrictName
            , 'ADDRESS_PHUONG_XA_THI_TRAN_CODE' => $this->addressWardCode
            , 'ADDRESS_PHUONG_XA_THI_TRAN_NAME' => $this->addressWardName
            , 'ADDRESS_TEN_DUONG' => $this->addressRoadName
            , 'ADDRESS_SO_NHA' => $this->addressNumber
            , 'ADDRESS_FULL_INFO' => $this->addressFullInfo
        ];
    }

    public static function createEmpty(): AddressDetailDto {
        return new self();
    }
}
