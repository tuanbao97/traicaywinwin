<?php

namespace App\Models;

use App\Enum\AppConstant;
use Illuminate\Database\Eloquent\Model;

class CategoryN extends Model
{
    /* Table mapping */
    protected $table = 'category_n';

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

    /* Thiêt lập giá trị mặc định cho instance */
    protected $attributes = [
        'ID' => null,
        'NAME' => null,
        'PARENT_ID' => null,
        'SORT_ORDER' => 0,
        'DESCRIPTION' => null,
        'TREE_LEVEL' => 1,
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

    public function avatars()
    {
        return $this->belongsToMany(DocumentStorage::class, 'category_n_document_storage', 'CATEGORY_N_ID', 'DOCUMENT_STORAGE_ID')
            // Lấy thêm các cột từ bảng trung gian
            ->withPivot(['SORT_ORDER', 'IS_ACTIVE', 'IS_THUMNAIL', 'CRT_DT', 'UPD_DT', 'CRT_ID', 'UPD_ID', 'CRT_NAME', 'UPD_NAME', 'STATUS', 'TYPE', 'EXTENSION', 'ATTR1', 'ATTR2'])
            // Ép kiểu dữ liệu trong bảng trung gian
            ->using(CategoryNDocumentStoragePivot::class)
            // Where thêm điu kiện bảng One To Many còn lại
            ->where(column: [
                ['document_storage.STATUS', '=', AppConstant::STATUS_USING]
            ])
            // Where chính bảng hiện tại
            ->where(column: [
                ['category_n_document_storage.STATUS', '=', AppConstant::STATUS_USING]
                , ['category_n_document_storage.ATTR1', '=', 'DANH_SACH_HINH_ANH_DAI_DIEN']
            ])
            ->orderBy('category_n_document_storage.SORT_ORDER', 'ASC')
            ->orderBy('category_n_document_storage.ID', 'ASC');
    }

    /**
     * Looping đệ quy dữ liệu childrens
     * 
     * @return
     */
    public function childrens() {
        return $this->hasMany(CategoryN::class, 'PARENT_ID', 'ID')
        ->where(
           [
               ['STATUS', '=', AppConstant::STATUS_USING]
           ] 
        )
        ->orderByRaw('
            CASE
                WHEN SORT_ORDER IS NOT NULL THEN SORT_ORDER
                ELSE 999999999
            END ASC
            , NAME ASC
        ')
        ->orderBy('CRT_DT', 'desc')
        ->with('childrens');
    }

    public function childrenNotRecursive() {
        return $this->hasMany(CategoryN::class, 'PARENT_ID', 'ID')    
            ->where(
                [
                    ['STATUS', '=', AppConstant::STATUS_USING]
                ]
            )
            ->orderBy('CRT_DT', 'desc');
    }

    public static function getAllChildCategoryIds(array $parentIds, $result = [], ?bool $isApiPublic = null)
    {
        // Nếu cần lọc parent active
        if ($isApiPublic === true && !empty($parentIds)) {
            $parentIds = CategoryN::query()
                ->whereIn('ID', $parentIds)
                ->where('IS_ACTIVE', true)
                ->pluck('ID')
                ->toArray();
        }

        if (empty($parentIds)) {
            // Nếu không còn parent nào active thì return luôn
            return array_unique($result);
        }

        $query = CategoryN::query()
            ->whereIn('PARENT_ID', $parentIds);

        if ($isApiPublic === true) {
            $query->where('IS_ACTIVE', true);
        }

        $children = $query->pluck('ID')->toArray();

        if (!empty($children)) {
            $result = array_merge($result, $children);
            $result = self::getAllChildCategoryIds($children, $result, $isApiPublic); // đệ quy
        }

        // Loại bỏ phần tử trùng lặp trước khi return
        return array_unique($result);
    }
}
