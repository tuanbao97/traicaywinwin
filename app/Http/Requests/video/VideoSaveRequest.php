<?php

namespace App\Http\Requests\video;

use App\Enum\AppConstant;
use App\Enum\PermissionEnum;
use App\Exceptions\BadRequestException;
use App\Rules\CheckNotExistsFieldRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class VideoSaveRequest extends FormRequest
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
            if ($permission->CODE === PermissionEnum::QL_VIDEO_CHINH_SUA->value) {
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
                'nullable',
                'integer'
            ],
            'TIEU_DE_VIDEO' => ['bail', 'required', 'string', 'max:1000'],
            'TOM_TAT_VIDEO' => ['bail', 'required', 'string', 'max:500'],
            'NOI_DUNG_VIDEO' => ['bail', 'required', 'string'],
            'NOI_DUNG_VIDEO_ONLY_TEXT' => ['bail', 'required', 'string'],
            'META_SEO_KEYWORDS' => ['bail', 'nullable', 'string', 'max:1000'],
            'META_SEO_DESCRIPTION' => ['bail', 'nullable', 'string', 'max:1000'],
            'VIDEO_NOI_BAT' => [
                'bail',
                'required',
                'boolean'
            ],
            'TRANG_THAI_HOAT_DONG' => [
                'bail',
                'required',
                'boolean'
            ],
            'DANH_SACH_HINH_ANH_DAI_DIEN' => [
                'bail',
                'required',
                'array'
            ],
            'DANH_SACH_HINH_ANH_DAI_DIEN.*.ID' => [
                'bail',
                'required',
                'integer'
            ],
            'DANH_SACH_FILE_DINH_KEM' => [
                'bail',
                'nullable',
                'array'
            ],
            'DANH_SACH_FILE_DINH_KEM.*.ID' => [
                'bail',
                'nullable',
                'integer'
            ],
        ];

        // Check tồn tại id video
        $id = $this->input('ID', null);
        $rules['ID'][] = new CheckNotExistsFieldRule('video', 'ID', $id, 'USING');

        // Check tồn tại danh sách hình ảnh đại diện
        $danhSachHinhAnhDaiDienUpload = $this->input('DANH_SACH_HINH_ANH_DAI_DIEN', null);
        if (!is_null($danhSachHinhAnhDaiDienUpload) && count($danhSachHinhAnhDaiDienUpload) > 0) {
            foreach($danhSachHinhAnhDaiDienUpload as $index => $value) {
                if (isset($value['ID'])) {
                    $documentStorageId = $value['ID'];
                    $rules['DANH_SACH_HINH_ANH_DAI_DIEN'][] = new CheckNotExistsFieldRule('document_storage', 'ID', $documentStorageId, 'USING');
                }
            }
        }

        // Check tồn tại danh sách file đính kèm
        $danhSachFileDinhKemUpload = $this->input('DANH_SACH_FILE_DINH_KEM', null);
        if (!is_null($danhSachFileDinhKemUpload) && count($danhSachFileDinhKemUpload) > 0) {
            foreach($danhSachFileDinhKemUpload as $index => $value) {
                if (isset($value['ID'])) {
                    $documentStorageId = $value['ID'];
                    $rules['DANH_SACH_FILE_DINH_KEM'][] = new CheckNotExistsFieldRule('document_storage', 'ID', $documentStorageId, 'USING');
                }
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
        $messagesForThisRequest = json_decode(file_get_contents(resource_path("lang/{$locale}/video/validation.json")), true);

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
    
    /* Override phương thức failedValidation để custom lại lỗi khi validate thất bại */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        // Throw bad request custom
        throw new BadRequestException($validator->errors(), 'Lưu thất bại.');
    }

}
