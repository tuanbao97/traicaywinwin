<?php

namespace App\Http\Requests\auth;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Rules\CheckNotExistsFieldRule;
use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    /* 403 Forbidden Xác định xem người dùng có được phép thực hiện yêu cầu này hay không. */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Chuẩn hóa dự liệu trước khi validate
     */
    protected function prepareForValidation()
    {
        // Merge các query param từ query param vào input array
        $this->merge([
            'USERNAME' => $this->input('EMAIL')
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
            'EMAIL' => [
                'bail',
                'required',
                'email'
            ],
            'USERNAME' => [
                'bail',
                'required'
            ]
        ];
        
        // Check tồn tại email
        $rules['EMAIL'][] = new CheckNotExistsFieldRule('user', 'EMAIL', $this->EMAIL, 'USING');

        return $rules;
    }

    /* Override phương thức messages để custom message lỗi trả về như mong muốn */
    public function messages()
    {
        $locale = app()->getLocale();
        $messages = json_decode(file_get_contents(resource_path("lang/{$locale}/validation.json")), true);
        
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
        $attributes = json_decode(file_get_contents(resource_path("lang/{$locale}/auth/attributes.json")), true);
        
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
        if (!empty($validator->failed())) {
            foreach ($validator->failed() as $index => $validatorFailed) {
                if ('EMAIL' === $index) {
                    $emailFailedRules = $validatorFailed;
                    
                    $collectionEmailFailedRules = collect($emailFailedRules);
                    $emailFailedRuleIsNotExists = $collectionEmailFailedRules->filter(function($value, $key) {
                        return $key == CheckNotExistsFieldRule::class;
                    });
                    if ($emailFailedRuleIsNotExists->isNotEmpty()) {
                        throw new NotFoundException($validator->errors(), 'Email không tồn tại.');
                    }
                }
            }
        }
        
        // Throw bad request custom
        throw new BadRequestException($validator->errors(), 'Reset password thất bại.');
    }
}
