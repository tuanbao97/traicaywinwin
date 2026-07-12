<?php

namespace App\Repository\impl;

use App\Models\OauthClient;
use App\Repository\BaseRepository;
use App\Repository\OauthClientRepository;
use Illuminate\Database\Eloquent\Collection;

class OauthClientRepositoryImpl extends BaseRepository implements OauthClientRepository
{
    public function getModel()
    {
        return OauthClient::class;
    }

    public function getListOauthClientWithGrantPasswordClient() : Collection {
        $query = OauthClient::query();
        $query->where([
            ['password_client', true ],
            ['personal_access_client', false],
            ['revoked', false]
        ]);
        $query->orderBy('created_at', 'desc');
        return $query->get();
    }

}
