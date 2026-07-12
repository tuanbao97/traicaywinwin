<?php

namespace App\Http\Requests\categoryn;

use App\Enum\AppConstant;
use App\Enum\PermissionEnum;
use App\Exceptions\BadRequestException;
use App\Rules\CheckNotExistsFieldRule;
use App\Service\AppService;
use Illuminate\Foundation\Http\FormRequest;

class CategoryNListRequest extends FormRequest
{
    private AppService $appService;

    public function __construct(AppService $appService) {
        $this->appService = $appService;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $route = $this->route();
        $routePrefix = $route->getPrefix();
        if ($routePrefix === AppConstant::PREFIX_API['API_PUBLIC']) return true; // Nếu là /api/public thì không cần check authorziration
        
        $currUser = $this->user();
        $permissions = $currUser->PERMISSIONS;
        foreach ($permissions as $index => $permission) {
            if ($permission->CODE === PermissionEnum::QL_DANH_MUC_TIN_TUC_DANH_SACH->value) {
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
            'PARENT_ID' => $this->query('PARENT_ID', null)
            , 'IS_GET_ALL_PARENT_AND_CHILDS' =>filter_var($this->query('IS_GET_ALL_PARENT_AND_CHILDS', false), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)
            , 'IS_GET_ALL_ELEMENTS' =>filter_var($this->query('IS_GET_ALL_ELEMENTS', false), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)
            , 'TRANG_THAI_HOAT_DONG' => $this->query('TRANG_THAI_HOAT_DONG', null) !== null
                ? filter_var($this->query('TRANG_THAI_HOAT_DONG'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)
                : null
            , 'TU_KHOA' => $this->query('TU_KHOA', null)
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
            'PARENT_ID' => [
                'bail',
                'nullable',
                'integer'
            ]
            , 'TRANG_THAI_HOAT_DONG' => [
                'bail'
                , 'nullable'
                , 'boolean'
            ]
        ];

        // Check tồn tại parent_id
        $parentId = $this->input('PARENT_ID');
        if (!is_null($parentId)) {
            $rules['PARENT_ID'][] = new CheckNotExistsFieldRule('category_n', 'ID', $parentId, 'USING');
        }
        
        return $rules;
    }

    /* Override phương thức messages để custom message lỗi trả về như mong muốn */
    public function messages()
    {
        $locale = app()->getLocale();
        $messages = json_decode(file_get_contents(resource_path("lang/{$locale}/validation.json")), true);
        
        /* Message for this request */
        $messagesForThisRequest = json_decode(file_get_contents(resource_path("lang/{$locale}/categoryn/validation.json")), true);
        
        /* Merge message from locale and for this request */
        $messages = array_merge($messages, $messagesForThisRequest);
        
        return $messages;
    }

    /* Override phương thức attributes để change label thành tên hiển thị lỗi như mong muốn */
    public function attributes()
    {
        $locale = app()->getLocale();
        $attributes = json_decode(file_get_contents(resource_path("lang/{$locale}/categoryn/attributes.json")), true);
        
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
