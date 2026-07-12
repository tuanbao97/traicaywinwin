<?php

namespace App\Http\Requests\user;

use App\Enum\AppConstant;
use App\Enum\PermissionEnum;
use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Rules\CheckNotExistsFieldRule;
use App\Rules\CheckEmailNotExistsRule;
use Illuminate\Foundation\Http\FormRequest;

class UserDetailSaveRequest extends FormRequest
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
            if ($permission->CODE === PermissionEnum::QL_NGUOI_DUNG_CHINH_SUA->value) {
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
        $this->merge(['ID' => $this->route('ID')]);
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'FULL_NAME' => [
                'bail',
                'required'
            ],
            'SO_DIEN_THOAI' => [
                'bail',
                'required'
            ],
            'VAI_TRO_ID' => [
                'bail',
                'required',
                'integer'
            ]
        ];
        
        // Check if this is create mode (ID is null) or edit mode
        if ($this->ID !== null) {
            // Edit mode - require ID and check user exists
            $rules['ID'] = [
                'bail',
                'required',
                'integer'
            ];
            $rules['ID'][] = new CheckNotExistsFieldRule('user', 'ID', $this->ID, 'USING');
        } else {
            // Create mode - require EMAIL and check email doesn't exist
            $rules['EMAIL'] = [
                'bail',
                'required',
                'email'
            ];
            // For create mode, we need to check that email doesn't exist
            $rules['EMAIL'][] = new CheckEmailNotExistsRule();
            
            // Create mode - require password and confirm password
            $rules['NEW_PASSWORD'] = [
                'bail',
                'required',
                'min:6'
            ];
            $rules['CONFIRM_PASSWORD'] = [
                'bail',
                'required',
                'same:NEW_PASSWORD'
            ];
        }
        
        // Check tồn tại Vai trò id
        $vaiTroId = $this->input('VAI_TRO_ID', null);
        $rules['VAI_TRO_ID'][] = new CheckNotExistsFieldRule('role', 'ID', $vaiTroId, 'USING');

        return $rules;
    }

    /* Override phương thức messages để custom message lỗi trả về như mong muốn */
    public function messages()
    {
        $locale = app()->getLocale();
        $messages = json_decode(file_get_contents(resource_path("lang/{$locale}/validation.json")), true);

        /* Message for this request */
        $messagesForThisRequest = json_decode(file_get_contents(resource_path("lang/{$locale}/user/validation.json")), true);
        
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
        // Kiểm tra mã lỗi là loại gì để throw exception cho chính xác loại 404 hay 400 ...
        $idFailedRules = $validator->failed()['ID'] ?? [];
        if (!empty($idFailedRules)) {
            $collectionIdFailedRules = collect($idFailedRules);
            $idFailedRuleNotFound = $collectionIdFailedRules->filter(function($value, $key) {
                return $key == CheckNotExistsFieldRule::class;
            });
            if ($idFailedRuleNotFound->isNotEmpty()) {
                throw new NotFoundException($validator->errors(), 'Người dùng không tồn tại.');
            }
        }
        
        // Throw bad request custom
        throw new BadRequestException($validator->errors(), 'Lưu người dùng thất bại.');
    }
}
