<?php

namespace App\Repository;

interface RepositoryInterface
{
    public function create(array $attributes);

    public function update($id, array $attributes);

    public function find($id);

    public function save(array $attributes, $primaryKey = 'ID');

}
