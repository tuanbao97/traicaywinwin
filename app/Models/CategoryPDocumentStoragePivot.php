<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryPDocumentStoragePivot extends Pivot
{
    protected $casts = [
         'IS_THUMNAIL' => 'boolean'
         , 'IS_ACTIVE' => 'boolean'
    ];

}
