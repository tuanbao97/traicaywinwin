<?php

namespace App\Models;

use App\Enum\AppConstant;
use Illuminate\Database\Eloquent\Relations\Pivot;

class NewsDocumentStoragePivot extends Pivot
{
    protected $table = 'news_document_storage';

    protected $primaryKey = 'ID';

    public $incrementing = true;

    protected $keyType = 'integer';

    const CREATED_AT = 'CRT_DT';
    const UPDATED_AT = 'UPD_DT';
    public $timestamps = true;

    protected $fillable = [
        'NEWS_ID',
        'DOCUMENT_STORAGE_ID',
        'SORT_ORDER',
        'IS_ACTIVE',
        'IS_THUMNAIL',
        'CRT_DT',
        'UPD_DT',
        'CRT_ID',
        'UPD_ID',
        'STATUS',
        'TYPE',
        'EXTENSION',
        'ATTR1',
        'ATTR2',
    ];

    protected $attributes = [
        'ID' => null,
        'NEWS_ID' => null,
        'DOCUMENT_STORAGE_ID' => null,
        'SORT_ORDER' => 0,
        'IS_ACTIVE' => true,
        'IS_THUMNAIL' => false,
        'CRT_DT' => null,
        'UPD_DT' => null,
        'CRT_ID' => null,
        'UPD_ID' => null,
        'STATUS' => 'USING',
        'TYPE' => null,
        'EXTENSION' => null,
        'ATTR1' => null,
        'ATTR2' => null,
    ];

    protected $casts = [
        'IS_ACTIVE' => 'boolean',
        'IS_THUMNAIL' => 'boolean',
        'CRT_DT' => 'datetime',
        'UPD_DT' => 'datetime',
    ];
} 