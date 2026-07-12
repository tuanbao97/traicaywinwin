<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    /* Table mapping */
    protected $table = 'province';

    /* Khóa chính */
    protected $primaryKey = 'CODE';

    /* Kiểu dữ liệu của khóa chính */
    protected $keyType = 'string';

    /* Lọc các column sẽ sử dụng */
    // protected $fillable = [];
    
    /* Lọc các column không sử dụng */
    protected $guarded = [];

    /* Ẩn các field khỏi arrays */
    protected $hidden = [];

    /* Set giá trị create_at và update_at khi thêm mới/ cập nhật dữ liệu */
    const CREATED_AT = 'CRT_DT';
    const UPDATED_AT = 'UPD_DT';
    public $timestamps = true;

    /* Thiêt lập giá trịm mặc định cho instance */
    protected $attributes = [
        'CODE' => null,
        'NAME' => null,
        'TYPE' => null,
        'SORT_ORDER' => 0,
        'PARENT_CODE' => null,
        'DESCRIPTION' => null,
        'CRT_DT' => null,
        'UPD_DT' => null,
        'CRT_ID' => null,
        'UPD_ID' => null,
        'CRT_NAME' => null,
        'UPD_NAME' => null,
        'STATUS' => 'USING',
        'IS_ACTIVE' => true
    ];

    /* Định nghĩa kiểu dữ liệu các attributes */
    protected $casts = [
        'IS_ACTIVE' => 'boolean',
        'CRT_DT' => 'datetime',
        'UPD_DT' => 'datetime',
    ];
    
}
