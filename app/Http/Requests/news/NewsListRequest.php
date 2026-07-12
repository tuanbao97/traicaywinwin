<?php

namespace App\Http\Requests\news;

use App\Enum\AppConstant;
use App\Enum\PermissionEnum;
use App\Exceptions\BadRequestException;
use App\Rules\CheckNotExistsFieldRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsListRequest extends FormRequest
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
            if ($permission->CODE === PermissionEnum::QL_TIN_TUC_DANH_SACH->value) {
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
        $arrDanhMucTinTuc = $this->query('DANH_MUC_TIN_TUC_ID', null);
        if (!is_null($arrDanhMucTinTuc) && count($arrDanhMucTinTuc) > 0) {
            $arrDanhMucTinTuc = array_filter($arrDanhMucTinTuc, function($item) {
                return $item !== 'all';
            });
        }

        // Xử lý loại tin tức: chỉ nhận true/false/null
        $loaiTinTuc = $this->input('LOAI_TIN_TUC', null);
        $loaiTinTuc = match($loaiTinTuc) {
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
            , 'DANH_MUC_TIN_TUC_ID' => $arrDanhMucTinTuc
            , 'BO_LOC' => $this->query('BO_LOC', null)
            , 'SORT' => $sort
            , 'LOAI_TIN_TUC' => $loaiTinTuc
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
            'DANH_MUC_TIN_TUC_ID' => [
                'bail',
                'nullable',
                'array'
            ]
            ,'DANH_MUC_TIN_TUC_ID.*' => [
                'bail',
                'required',
                'integer'
            ]
            , 'TRANG_THAI_HOAT_DONG' => [
                'bail'
                , 'nullable'
                , 'boolean'
            ]
            , 'BO_LOC' => [
                'bail'
                , 'nullable'
                , 'string'
                , Rule::in(AppConstant::DANH_SACH_BO_LOC_TIM_KIEM)
            ]
            , 'LOAI_TIN_TUC' => [
                'bail',
                'nullable',
                'boolean'
            ]
        ];

        // Check tồn tại danh mục tin tức
        $arrDanhMucTinTucId = $this->query('DANH_MUC_TIN_TUC_ID', null);
        if (!is_null($arrDanhMucTinTucId) && is_array($arrDanhMucTinTucId)) {
            foreach($arrDanhMucTinTucId as $index => $danhMucTinTucId) {
                if (is_numeric($danhMucTinTucId)) $rules['DANH_MUC_TIN_TUC_ID'][] = new CheckNotExistsFieldRule('category_n', 'ID', $danhMucTinTucId, 'USING');
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
        $messagesForThisRequest = json_decode(file_get_contents(resource_path("lang/{$locale}/news/validation.json")), true);
        
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
        $attributes = json_decode(file_get_contents(resource_path("lang/{$locale}/news/attributes.json")), true);
        
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