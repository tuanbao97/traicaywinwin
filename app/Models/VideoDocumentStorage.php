<?php

namespace App\Models;

use App\Enum\AppConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoDocumentStorage extends Model
{
    use HasFactory;

    /* Table mapping */
    protected $table = 'video_document_storage';

    /* Khóa chính */
    protected $primaryKey = 'ID';

    /* Kiểu dữ liệu của khóa chính */
    protected $keyType = 'integer';

    /* Khóa chính này là kiểu số tự tăng */
    public $incrementing = true;

    /* Lọc các column sẽ sử dụng */
    protected $fillable = [
        'VIDEO_ID',
        'DOCUMENT_STORAGE_ID',
        'SORT_ORDER',
        'IS_ACTIVE',
        'IS_THUMNAIL',
        'TYPE',
        'EXTENSION',
        'ATTR1',
        'STATUS',
        'CRT_ID',
        'UPD_ID',
        'CRT_NAME',
        'UPD_NAME'
    ];

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
        'VIDEO_ID' => null,
        'DOCUMENT_STORAGE_ID' => null,
        'SORT_ORDER' => 0,
        'IS_ACTIVE' => true,
        'IS_THUMNAIL' => false,
        'TYPE' => null,
        'EXTENSION' => null,
        'ATTR1' => null,
        'STATUS' => 'USING',
        'CRT_ID' => null,
        'UPD_ID' => null,
        'CRT_NAME' => null,
        'UPD_NAME' => null
    ];

    /* Định nghĩa kiểu dữ liệu các attributes */
    protected $casts = [
        'IS_ACTIVE' => 'boolean',
        'IS_THUMNAIL' => 'boolean',
        'CRT_DT' => 'datetime',
        'UPD_DT' => 'datetime',
    ];

    /**
     * Get the video that owns the document storage.
     */
    public function video()
    {
        return $this->belongsTo(Video::class, 'VIDEO_ID', 'ID')
            ->where([
                ['video.STATUS', '=', AppConstant::STATUS_USING]
            ]);
    }

    /**
     * Get the document storage that belongs to the video.
     */
    public function documentStorage()
    {
        return $this->belongsTo(DocumentStorage::class, 'DOCUMENT_STORAGE_ID', 'ID')
            ->where([
                ['document_storage.STATUS', '=', AppConstant::STATUS_USING]
            ]);
    }
}
