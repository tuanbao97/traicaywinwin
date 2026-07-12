<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryNDocumentStoragePivot extends Pivot
{
    protected $casts = [
         'IS_THUMNAIL' => 'boolean'
         , 'IS_ACTIVE' => 'boolean'
    ];

}
