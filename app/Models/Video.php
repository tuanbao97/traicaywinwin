<?php

namespace App\Models;

use App\Enum\AppConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Video extends Model
{
    use HasFactory;

    /* Table mapping */
    protected $table = 'video';

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
        'TITLE' => null,
        'SUMMARY' => null,
        'CONTENT_FORMAT' => null,
        'CONTENT_RAW' => null,
        'META_SEO_KEYWORDS' => null,
        'META_SEO_DESCRIPTION' => null,
        'IS_HOT_VIDEO' => false,
        'COUNT_VIEWS' => 0,

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
        'IS_HOT_VIDEO' => 'boolean',
        'CRT_DT' => 'datetime',
        'UPD_DT' => 'datetime',
    ];

    /**
     * Get the images for the video (thumbnail).
     */
    public function images(): BelongsToMany {
        return $this->belongsToMany(DocumentStorage::class, 'video_document_storage', 'VIDEO_ID', 'DOCUMENT_STORAGE_ID')
            // Lấy thêm các cột từ bảng trung gian
            ->withPivot(['SORT_ORDER', 'IS_ACTIVE', 'IS_THUMNAIL', 'CRT_DT', 'UPD_DT', 'CRT_ID', 'UPD_ID', 'STATUS', 'TYPE', 'EXTENSION', 'ATTR1'])
            // Ép kiểu dữ liệu trong bảng trung gian
            ->using(VideoDocumentStoragePivot::class)
            // Where thêm điều kiện bảng One To Many còn lại
            ->where([
                ['document_storage.STATUS', '=', AppConstant::STATUS_USING]
            ])
            // Where chính bảng hiện tại
            ->where([
                ['video_document_storage.STATUS', '=', AppConstant::STATUS_USING],
                ['video_document_storage.ATTR1', '=', 'DANH_SACH_HINH_ANH_DAI_DIEN']
            ])
            ->orderBy('video_document_storage.SORT_ORDER', 'ASC')
            ->orderBy('video_document_storage.ID', 'ASC');
    }

    /**
     * Get the files for the video (attachments).
     */
    public function files(): BelongsToMany {
        return $this->belongsToMany(DocumentStorage::class, 'video_document_storage', 'VIDEO_ID', 'DOCUMENT_STORAGE_ID')
            // Lấy thêm các cột từ bảng trung gian
            ->withPivot(['SORT_ORDER', 'IS_ACTIVE', 'IS_THUMNAIL', 'CRT_DT', 'UPD_DT', 'CRT_ID', 'UPD_ID', 'STATUS', 'TYPE', 'EXTENSION', 'ATTR1'])
            // Ép kiểu dữ liệu trong bảng trung gian
            ->using(VideoDocumentStoragePivot::class)
            // Where thêm điều kiện bảng One To Many còn lại
            ->where([
                ['document_storage.STATUS', '=', AppConstant::STATUS_USING]
            ])
            // Where chính bảng hiện tại
            ->where([
                ['video_document_storage.STATUS', '=', AppConstant::STATUS_USING],
                ['video_document_storage.ATTR1', '=', 'DANH_SACH_FILE_DINH_KEM']
            ])
            ->orderBy('video_document_storage.SORT_ORDER', 'ASC')
            ->orderBy('video_document_storage.ID', 'ASC');
    }
}