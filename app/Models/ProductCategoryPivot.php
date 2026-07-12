<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductCategoryPivot extends Pivot
{
    use HasFactory;

     /* Định nghĩa kiểu dữ liệu các attributes */
     protected $casts = [
        'IS_ACTIVE' => 'boolean'
    ];

}
