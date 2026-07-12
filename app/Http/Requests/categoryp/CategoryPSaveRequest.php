<?php

namespace App\Http\Requests\categoryp;

use App\Enum\AppConstant;
use App\Enum\PermissionEnum;
use App\Exceptions\BadRequestException;
use App\Rules\CheckDuplicateFieldRule;
use App\Rules\CheckNotExistsFieldRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryPSaveRequest extends FormRequest
{
    /* Xác định xem người dùng có được phép thực hiện yêu cầu này hay không. */
    public function authorize(): bool
    {
        $route = $this->route();
        $routePrefix = $route->getPrefix();
        if ($routePrefix === AppConstant::PREFIX_API['API_PUBLIC']) return true; // Nếu là /api/public thì không cần check authorziration
        
        $currUser = $this->user();
        $permissions = $currUser->PERMISSIONS;
        foreach ($permissions as $index => $permission) {
            if ($permission->CODE === PermissionEnum::QL_DANH_MUC_SAN_PHAM_CHINH_SUA->value) {
                return true;
            }
        }
        return false;
    }

    /**
     * Chuẩn hóa dự liệu trước khi validate
     */
    protected function prepareForValidation()
    {
        // Merge các query param từ query param vào input array
        $this->merge([]);
    }
    
    /* Set rule validate cho request này */
    public function rules(): array
    {
        $rules = [
            'ID' => [
                'bail',
                'nullable',
                'integer'
            ]
            , 'PARENT_ID' => [
                'bail',
                'nullable',
                'integer',
                'different:ID'
            ]
            , 'TEN_DANH_MUC_SAN_PHAM' => [
                'bail',
                'required',
                'max:1000',
            ]
            , 'SORT_ORDER' => [
                'bail',
                'required',
                'integer'
            ]
            , 'TREE_LEVEL' => [
                'bail',
                'required',
                'integer'
            ]
            , 'TRANG_THAI_HOAT_DONG' => [
                'bail',
                'nullable',
                'boolean'
            ]
            , 'CRT_DT' => [
                'bail',
                'nullable',
                'date'
            ]
            , 'UPD_DT' => [
                'bail',
                'nullable',
                'date'
            ]
            , 'DANH_SACH_HINH_ANH_DAI_DIEN' => [
                'bail'
                , 'nullable'
                , 'array' // Bắt buộc phải là 1 mảng/ object trong laravel
            ]
            , 'DANH_SACH_HINH_ANH_DAI_DIEN.*.ID' => [
                'bail'
                , 'required'
                , 'integer'
            ]
        ];

        // Check là tạo mới hay cập nhật
        $id = $this->input('ID') ?? null;
        
        $rules['TEN_DANH_MUC_SAN_PHAM'][] = new CheckDuplicateFieldRule('category_p', 'NAME', $this->TEN_DANH_MUC_SAN_PHAM, 'USING', $id);
        if (!is_null($id)) { // Create
            $rules['ID'][] = new CheckNotExistsFieldRule('category_p', 'ID', $this->ID, 'USING');
        }

        // Check tồn tại parent_id
        $parent_id = $this->input('PARENT_ID');
        if (!is_null($parent_id)) {
            $rules['PARENT_ID'][] = new CheckNotExistsFieldRule('category_p', 'ID', $parent_id, 'USING');
        }

        // Check tồn tại danh sách hình ảnh đại diện
        $danhSachHinhAnhDaiDienUpload = $this->input('DANH_SACH_HINH_ANH_DAI_DIEN', null);
        if (!is_null($danhSachHinhAnhDaiDienUpload) && count($danhSachHinhAnhDaiDienUpload) > 0) {
            foreach($danhSachHinhAnhDaiDienUpload as $index => $value) {
                // Check tồn tại hình ảnh upload
                $documentStorageId = $value['ID'];
                $rules['DANH_SACH_HINH_ANH_DAI_DIEN'][] = new CheckNotExistsFieldRule('document_storage', 'ID', $documentStorageId, 'USING');
            }
        }
        
        return $rules;
    }
    
    /* Override phương thức messages để custom message lỗi trả về như mong muốn */
    public function messages()
    {
        $locale = app()->getLocale();
        $messages = json_decode(file_get_contents(resource_path("lang/{$locale}/validation.json")), true);

        /* Message for this request */
        $messagesForThisRequest = json_decode(file_get_contents(resource_path("lang/{$locale}/categoryp/validation.json")), true);

        /* Merge message from locale and for this request */
        $messages = array_merge($messages, $messagesForThisRequest);

        return $messages;
    }
    
    /* Override phương thức attributes để change label thành tên hiển thị lỗi như mong muốn */
    public function attributes()
    {
        $locale = app()->getLocale();
        $attributes = json_decode(file_get_contents(resource_path("lang/{$locale}/categoryp/attributes.json")), true);
        
        /* Attributes for this request */
        $attributesForThisRequest = [
            'other' => $this->ID,
        ];

        /* Merge message from locale and for this request */
        $attributes = array_merge($attributes, $attributesForThisRequest);

        return $attributes;
    }
    
    /* Override phương thức failedValidation để custom lại lỗi khi validate thất bại */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        // Throw bad request custom
        throw new BadRequestException($validator->errors(), 'Lưu thất bại.');
    }
    
}
