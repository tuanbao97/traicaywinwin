<?php

namespace App\Dto\auth;

use Carbon\Carbon;

class OauthClientDto implements \JsonSerializable
{

    public int $id;

    public string $name;

    public string $secret;

    public string $provider;

    public string $redirect;

    public bool $personalAccessClient;

    public bool $passportClient;

    public bool $revoked;

    public ?Carbon $createdAt; // timestamp kiểu nullable

    public ?Carbon $updatedAt; // timestamp kiểu nullable
    
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /* Hiển thị tên json thay thế */
    public function jsonSerialize(): mixed {
        return [
            'ID' => $this->id
            , 'NAME' => $this->name
            , 'SECRET' => $this->secret
            , 'PROVIDER' => $this->provider
            , 'REDIRECT' => $this->redirect
            , 'PERSONAL_ACCESS_CLIENT' => $this->personalAccessClient
            , 'PASSPORT_CLIENT' => $this->passportClient
            , 'REVOKED' => $this->revoked
            , 'CREATED_AT' => $this->createdAt
            , 'UPDATED_AT' => $this->updatedAt
        ];
    }

}
