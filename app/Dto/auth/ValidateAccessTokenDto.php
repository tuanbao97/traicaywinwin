<?php

namespace App\Dto\auth;

class ValidateAccessTokenDto
{
    public bool $isValid = false;
    public ?Object $validRequest;
    
    public function __construct(bool $isValid, ?Object $validRequest)
    {
        $this->isValid = $isValid;
        $this->validRequest = $validRequest;
    }

}
