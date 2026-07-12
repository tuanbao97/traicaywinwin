<?php

namespace App\Repository;

interface NewsCategoryRepository extends RepositoryInterface
{
    public function saveNewsCategories($newsId, array $categories);

    public function deleteAllTinTucDanhMucTinTuc($newsId) : bool;
} 