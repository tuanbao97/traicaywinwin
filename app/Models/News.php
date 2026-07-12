<?php

namespace App\Models;

use App\Enum\AppConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class News extends Model
{
    use HasFactory;

    /* Table mapping */
    protected $table = 'news';

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
        'APPROVED_DATE' => null,
        'PUBLISHED_DATE' => null,
        'IS_HOT_NEWS' => false,
        'COUNT_VIEWS' => 0,
        'IS_APPROVED' => false,
        'USER_POST_NEWS_ID' => null,
        'USER_APPROVED_POST_NEWS_ID' => null,

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
        'IS_HOT_NEWS' => 'boolean',
        'IS_APPROVED' => 'boolean',
        'APPROVED_DATE' => 'datetime',
        'PUBLISHED_DATE' => 'datetime',
        'CRT_DT' => 'datetime',
        'UPD_DT' => 'datetime',
    ];

    public function avatars()
    {
        return $this->belongsToMany(DocumentStorage::class, 'news_document_storage', 'NEWS_ID', 'DOCUMENT_STORAGE_ID')
            // Lấy thêm các cột từ bảng trung gian
            ->withPivot(['SORT_ORDER', 'IS_ACTIVE', 'IS_THUMNAIL', 'CRT_DT', 'UPD_DT', 'CRT_ID', 'UPD_ID', 'STATUS', 'TYPE', 'EXTENSION', 'ATTR1', 'ATTR2'])
            // Ép kiểu dữ liệu trong bảng trung gian
            ->using(NewsDocumentStoragePivot::class)
            // Where thêm điều kiện bảng One To Many còn lại
            ->where(column: [
                ['document_storage.STATUS', '=', AppConstant::STATUS_USING]
            ])
            // Where chính bảng hiện tại
            ->where(column: [
                ['news_document_storage.STATUS', '=', AppConstant::STATUS_USING]
                , ['news_document_storage.ATTR1', '=', 'DANH_SACH_HINH_ANH_DAI_DIEN']
            ])
            ->orderBy('news_document_storage.SORT_ORDER', 'ASC')
            ->orderBy('news_document_storage.ID', 'ASC');
    }

    public function images(): BelongsToMany {
        return $this->belongsToMany(DocumentStorage::class, 'news_document_storage', 'NEWS_ID', 'DOCUMENT_STORAGE_ID')
            // Lấy thêm các cột từ bảng trung gian
            ->withPivot(['SORT_ORDER', 'IS_ACTIVE', 'IS_THUMNAIL', 'CRT_DT', 'UPD_DT', 'CRT_ID', 'UPD_ID', 'STATUS', 'TYPE', 'EXTENSION', 'ATTR1', 'ATTR2'])
            // Ép kiểu dữ liệu trong bảng trung gian
            ->using(NewsDocumentStoragePivot::class)
            // Where thêm điều kiện bảng One To Many còn lại
            ->where(column: [
                ['document_storage.STATUS', '=', AppConstant::STATUS_USING]
            ])
            // Where chính bảng hiện tại
            ->where(column: [
                ['news_document_storage.STATUS', '=', AppConstant::STATUS_USING]
                , ['news_document_storage.ATTR1', '=', 'DANH_SACH_HINH_ANH']
            ])
            ->orderBy('news_document_storage.SORT_ORDER', 'ASC')
            ->orderBy('news_document_storage.ID', 'ASC');
    }

    public function videos(): BelongsToMany {
        return $this->belongsToMany(DocumentStorage::class, 'news_document_storage', 'NEWS_ID', 'DOCUMENT_STORAGE_ID')
            // Lấy thêm các cột từ bảng trung gian
            ->withPivot(['SORT_ORDER', 'IS_ACTIVE', 'IS_THUMNAIL', 'CRT_DT', 'UPD_DT', 'CRT_ID', 'UPD_ID', 'STATUS', 'TYPE', 'EXTENSION', 'ATTR1', 'ATTR2'])
            // Ép kiểu dữ liệu trong bảng trung gian
            ->using(NewsDocumentStoragePivot::class)
            // Where thêm điều kiện bảng One To Many còn lại
            ->where(column: [
                ['document_storage.STATUS', '=', AppConstant::STATUS_USING]
            ])
            // Where chính bảng hiện tại
            ->where(column: [
                ['news_document_storage.STATUS', '=', AppConstant::STATUS_USING]
                , ['news_document_storage.ATTR1', '=', 'DANH_SACH_VIDEO']
            ])
            ->orderBy('news_document_storage.SORT_ORDER', 'ASC')
            ->orderBy('news_document_storage.ID', 'ASC');
    }

    public function files(): BelongsToMany {
        return $this->belongsToMany(DocumentStorage::class, 'news_document_storage', 'NEWS_ID', 'DOCUMENT_STORAGE_ID')
            // Lấy thêm các cột từ bảng trung gian
            ->withPivot(['SORT_ORDER', 'IS_ACTIVE', 'IS_THUMNAIL', 'CRT_DT', 'UPD_DT', 'CRT_ID', 'UPD_ID', 'STATUS', 'TYPE', 'EXTENSION', 'ATTR1', 'ATTR2'])
            // Ép kiểu dữ liệu trong bảng trung gian
            ->using(NewsDocumentStoragePivot::class)
            // Where thêm điều kiện bảng One To Many còn lại
            ->where(column: [
                ['document_storage.STATUS', '=', AppConstant::STATUS_USING]
            ])
            // Where chính bảng hiện tại
            ->where(column: [
                ['news_document_storage.STATUS', '=', AppConstant::STATUS_USING]
                , ['news_document_storage.ATTR1', '=', 'DANH_SACH_FILE_DINH_KEM']
            ])
            ->orderBy('news_document_storage.SORT_ORDER', 'ASC')
            ->orderBy('news_document_storage.ID', 'ASC');
    }

    public function categories()
    {
        return $this->belongsToMany(CategoryN::class, 'news_category', 'NEWS_ID', 'CATEGORY_ID')
            // Lấy thêm các cột từ bảng trung gian
            ->withPivot(['SORT_ORDER', 'IS_ACTIVE', 'CRT_DT', 'UPD_DT', 'CRT_ID', 'UPD_ID', 'STATUS'])
            // Ép kiểu dữ liệu trong bảng trung gian
            ->using(NewsCategoryPivot::class)
            // Where thêm điều kiện bảng One To Many còn lại
            ->where(column: [
                ['category_n.STATUS', '=', AppConstant::STATUS_USING]
            ])
            // Where chính bảng hiện tại
            ->where([
                ['news_category.STATUS', '=', AppConstant::STATUS_USING]
            ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'USER_POST_NEWS_ID', 'ID')
            // Where thêm điều kiện bảng
            ->where([
                ['user.STATUS', '=', AppConstant::STATUS_USING]
            ]);
    }

    public function approvedUser()
    {
        return $this->belongsTo(User::class, 'USER_APPROVED_POST_NEWS_ID', 'ID')
            // Where thêm điều kiện bảng
            ->where([
                ['user.STATUS', '=', AppConstant::STATUS_USING]
            ]);
    }
} 