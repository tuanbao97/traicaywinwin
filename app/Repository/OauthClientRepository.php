<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;

interface OauthClientRepository extends RepositoryInterface
{

    public function getListOauthClientWithGrantPasswordClient() : Collection;

}
