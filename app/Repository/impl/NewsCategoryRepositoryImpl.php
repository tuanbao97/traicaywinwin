<?php

namespace App\Repository\impl;

use App\Enum\AppConstant;
use App\Models\NewsCategory;
use App\Repository\BaseRepository;
use App\Repository\NewsCategoryRepository;
use Illuminate\Support\Facades\DB;

class NewsCategoryRepositoryImpl extends BaseRepository implements NewsCategoryRepository
{
    public function getModel()
    {
        return NewsCategory::class;
    }

    public function saveNewsCategories($newsId, array $categories)
    {
        foreach ($categories as $category) {
            $newsCategory = new NewsCategory();
            $newsCategory->NEWS_ID = $newsId;
            $newsCategory->CATEGORY_ID = $category['CATEGORY_ID'];
            $newsCategory->SORT_ORDER = $category['SORT_ORDER'] ?? 0;
            $newsCategory->IS_ACTIVE = $category['IS_ACTIVE'] ?? true;
            $newsCategory->STATUS = AppConstant::STATUS_USING;
            $newsCategory->save();
        }
    }

    public function deleteAllTinTucDanhMucTinTuc($newsId) : bool
    {
        return DB::table('news_category')
            ->where('NEWS_ID', $newsId)
            ->delete();
    }
} 