<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPDocumentStorage extends Model
{
    /* Table mapping */
    protected $table = 'category_p_document_storage';
    
    /* Khóa chính */
    protected $primaryKey = 'ID';
    
    /* Kiểu dữ liệu của khóa chính */
    protected $keyType = 'integer';
    
    /* Khóa chính này là kiểu số tự tăng */
    public $incrementing = true;
    
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
        'ID' => null,
        'CATEGORY_P_ID' => null,
        'DOCUMENT_STORAGE_ID' => null,
        'SORT_ORDER' => 0,
        'IS_THUMNAIL' => false,
        'TYPE' => null,
        'EXTENSION' => null,
        'CRT_DT' => null,
        'UPD_DT' => null,
        'CRT_ID' => null,
        'UPD_ID' => null,
        'CRT_NAME' => null,
        'UPD_NAME' => null,
        'STATUS' => 'USING'
    ];
    
    /* Định nghĩa kiểu dữ liệu các attributes */
    protected $casts = [
        'IS_THUMNAIL' => 'boolean',
        'CRT_DT' => 'datetime',
        'UPD_DT' => 'datetime',
    ];

}
