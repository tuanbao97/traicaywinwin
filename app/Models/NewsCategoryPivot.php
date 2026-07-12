<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class NewsCategoryPivot extends Pivot
{
    protected $table = 'news_category';

    protected $primaryKey = 'ID';

    public $incrementing = true;

    protected $keyType = 'integer';

    const CREATED_AT = 'CRT_DT';
    const UPDATED_AT = 'UPD_DT';
    public $timestamps = true;

    protected $fillable = [
        'NEWS_ID',
        'CATEGORY_ID',
        'SORT_ORDER',
        'IS_ACTIVE',
        'CRT_DT',
        'UPD_DT',
        'CRT_ID',
        'UPD_ID',
        'STATUS'
    ];

    protected $casts = [
        'IS_ACTIVE' => 'boolean',
        'CRT_DT' => 'datetime',
        'UPD_DT' => 'datetime',
    ];
} 