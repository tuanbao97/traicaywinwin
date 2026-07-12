<?php

namespace App\Http\Requests\categoryp;

use App\Enum\AppConstant;
use App\Enum\PermissionEnum;
use App\Exceptions\NotFoundException;
use App\Rules\CheckNotExistsFieldRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\BadRequestException;
use App\Service\AppService;

class CategoryPDetailRequest extends FormRequest
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
            if ($permission->CODE === PermissionEnum::QL_DANH_MUC_SAN_PHAM_CHI_TIET->value) {
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
            'ID' => [
                'bail',
                'required',
                'integer'
            ]
        ];
        
        // Check tồn tại id
        $rules['ID'][] = new CheckNotExistsFieldRule('category_p', 'ID', $this->ID, 'USING');
        
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
        // Kiểm tra mã lỗi là loại gì để throw exception cho chính xác loại 404 hay 400 ...
        $idFailedRules = $validator->failed()['ID'] ?? [];
        if (!empty($idFailedRules)) {
            $collectionIdFailedRules = collect($idFailedRules);
            $idFailedRuleNotFound = $collectionIdFailedRules->filter(function($value, $key) {
                return $key == CheckNotExistsFieldRule::class;
            });
            if ($idFailedRuleNotFound->isNotEmpty()) {
                throw new NotFoundException($validator->errors(), 'Danh mục sản phẩm không tồn tại.');
            }
        }
        
        // Throw bad request custom
        throw new BadRequestException($validator->errors(), 'Truy vấn thất bại.');
    }

}
