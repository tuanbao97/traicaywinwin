<?php

namespace App\Http\Requests\user;

use App\Enum\AppConstant;
use App\Enum\PermissionEnum;
use App\Exceptions\BadRequestException;
use App\Rules\CheckNotExistsFieldRule;
use Illuminate\Foundation\Http\FormRequest;

class UserListRequest extends FormRequest
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
            if ($permission->CODE === PermissionEnum::QL_NGUOI_DUNG_DANH_SACH->value) {
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
    $this->merge([
        'DRAW' => $this->query('draw', 1)
        , 'TU_KHOA' => $this->query('TU_KHOA', null)
        , 'TRANG_THAI_HOAT_DONG' => $this->query('TRANG_THAI_HOAT_DONG', null) !== null
            ? filter_var($this->query('TRANG_THAI_HOAT_DONG'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)
            : null
        , 'VAI_TRO_ID' => $this->query('VAI_TRO_ID', 'all') != 'all' ? $this->query('VAI_TRO_ID') : null
    ]);
    }
    
    /**
     * Get the validation rules that apply to the request.
    *
    * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    */
    public function rules(): array
    {
    $rules = [
        'TRANG_THAI_HOAT_DONG' => [
            'bail'
            , 'nullable'
            , 'boolean'
        ],
        'VAI_TRO_ID' => [
            'bail',
            'nullable',
        ]
    ];

        // Check tồn tại vai trò
    $vaiTroId = $this->input('VAI_TRO_ID', null);
    if (!is_null($vaiTroId)) {
        $rules['VAI_TRO_ID'][] = new CheckNotExistsFieldRule('role', 'ID', $vaiTroId, 'USING');
    }

    return $rules;
    }

    /* Override phương thức messages để custom message lỗi trả về như mong muốn */
    public function messages()
    {
        $locale = app()->getLocale();
        $messages = json_decode(file_get_contents(resource_path("lang/{$locale}/validation.json")), true);

        /* Message for this request */
        $messagesForThisRequest = json_decode(file_get_contents(resource_path("lang/{$locale}/user/validation.json")), true);
        
        /* Message for this request */
        $messagesForThisRequest = [
            
        ];
        
        /* Merge message from locale and for this request */
        $messages = array_merge($messages, $messagesForThisRequest);
        
        return $messages;
    }

    /* Override phương thức attributes để change label thành tên hiển thị lỗi như mong muốn */
    public function attributes()
    {
        $locale = app()->getLocale();
        $attributes = json_decode(file_get_contents(resource_path("lang/{$locale}/user/attributes.json")), true);
        
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
        throw new BadRequestException($validator->errors(), 'Truy vấn thất bại.');
    }
}
