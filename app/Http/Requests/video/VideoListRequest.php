<?php

namespace App\Http\Requests\video;

use App\Enum\AppConstant;
use App\Enum\PermissionEnum;
use App\Exceptions\BadRequestException;
use Illuminate\Foundation\Http\FormRequest;

class VideoListRequest extends FormRequest
{
    public function authorize(): bool
    {
        $route = $this->route();
        $routePrefix = $route->getPrefix();
        if ($routePrefix === AppConstant::PREFIX_API['API_PUBLIC']) return true;

        $currUser = $this->user();
        $permissions = $currUser->PERMISSIONS;
        foreach ($permissions as $index => $permission) {
            if ($permission->CODE === PermissionEnum::QL_VIDEO_DANH_SACH->value) {
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
        // Xử lý loại video: chỉ nhận true/false/null
        $loaiVideo = $this->input('LOAI_VIDEO', null);
        $loaiVideo = match($loaiVideo) {
            'all', '', null => null,
            'true', true => true,
            'false', false => false,
            default => null
        };

        // Sort
        $sort = $this->query('SORT', null);

        // Merge các query param từ query param vào input array
        $this->merge([
            'DRAW' => $this->query('draw', 1)
            , 'TU_KHOA' => $this->query('TU_KHOA', null)
            , 'TRANG_THAI_HOAT_DONG' => $this->query('TRANG_THAI_HOAT_DONG', null) !== null
                ? filter_var($this->query('TRANG_THAI_HOAT_DONG'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)
                : null
            , 'BO_LOC' => $this->query('BO_LOC', null)
            , 'LOAI_VIDEO' => $loaiVideo
            , 'SORT' => $sort
        ]);
    }

    public function rules(): array
    {
        $rules = [
            'TRANG_THAI_HOAT_DONG' => [
                'bail'
                , 'nullable'
                , 'boolean'
            ]
            , 'LOAI_VIDEO' => [
                'bail'
                , 'nullable'
                , 'boolean'
            ]
            , 'BO_LOC' => [
                'bail'
                , 'nullable'
                , 'string'
            ]
        ];
        
        return $rules;
    }

    /* Override phương thức messages để custom message lỗi trả về như mong muốn */
    public function messages()
    {
        $locale = app()->getLocale();
        $messages = json_decode(file_get_contents(resource_path("lang/{$locale}/validation.json")), true);

        /* Message for this request */
        $messagesForThisRequest = json_decode(file_get_contents(resource_path("lang/{$locale}/video/validation.json")), true);
        
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
        $attributes = json_decode(file_get_contents(resource_path("lang/{$locale}/video/attributes.json")), true);
        
        /* Attributes for this request */
        $attributesForThisRequest = [
            'other' => $this->ID,
        ];
        
        /* Merge message from locale and for this request */
        $attributes = array_merge($attributes, $attributesForThisRequest);
        
        return $attributes;
    }

    /* Override phương thức failedValidation để custom response lỗi như mong muốn */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new BadRequestException($validator->errors()->first());
    }
}
