<?php

namespace App\Http\Requests\documentStorage;

use App\Exceptions\BadRequestException;
use App\Rules\CheckNotExistsFieldRule;
use Illuminate\Foundation\Http\FormRequest;

class ImageUpdateDetailRequest extends FormRequest
{
    /* Xác định xem người dùng có được phép thực hiện yêu cầu này hay không. */
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
        $this->merge(['ID' => $this->route('ID')]);
    }
    
    /* Set rule validate cho request này */
    public function rules(): array
    {
        $rules = [
            'ID' => [
                'bail'
                , 'required'
                , 'integer'
            ]
            , 'TEN_HINH_ANH' => [
                'bail'
                , 'required'
                , 'string'
                , 'max:255' // Tối đa 255 kí tự
            ]
            , 'MO_TA' => [
                'bail'
                , 'nullable'
                , 'string'
                , 'max:2000' // Tối đâ 2000 kí tự
            ]
        ];

        // Check tồn tại id document storage
        $id = $this->input('ID', null);
        $rules['ID'][] = new CheckNotExistsFieldRule('document_storage', 'ID', $id, 'USING');
        
        return $rules;
    }

    /* Override phương thức messages để custom message lỗi trả về như mong muốn */
    public function messages()
    {
        $locale = app()->getLocale();
        $messages = json_decode(file_get_contents(resource_path("lang/{$locale}/validation.json")), true);

        /* Message for this request */
        $messagesForThisRequest = json_decode(file_get_contents(resource_path("lang/{$locale}/documentStorage/hinh-anh/validation.json")), true);

        /* Merge message from locale and for this request */
        $messages = array_merge($messages, $messagesForThisRequest);

        return $messages;
    }
    
    /* Override phương thức attributes để change label thành tên hiển thị lỗi như mong muốn */
    public function attributes()
    {
        $locale = app()->getLocale();
        $attributes = json_decode(file_get_contents(resource_path("lang/{$locale}/documentStorage/hinh-anh/attributes.json")), true);
        
        /* Attributes for this request */
        $attributesForThisRequest = [
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
