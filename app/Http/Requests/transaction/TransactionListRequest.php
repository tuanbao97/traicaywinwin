<?php

namespace App\Http\Requests\transaction;

use App\Enum\AppConstant;
use App\Enum\PermissionEnum;
use App\Exceptions\BadRequestException;
use Illuminate\Foundation\Http\FormRequest;

class TransactionListRequest extends FormRequest
{
    public function authorize(): bool
    {
        $route = $this->route();
        $routePrefix = $route->getPrefix();
        if ($routePrefix === AppConstant::PREFIX_API['API_PUBLIC']) {
            return true;
        }

        $currUser = $this->user();
        $permissions = $currUser->PERMISSIONS;
        foreach ($permissions as $permission) {
            if ($permission->CODE === PermissionEnum::QL_DON_HANG_DANH_SACH->value) {
                return true;
            }
        }

        return false;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'DRAW' => $this->query('draw', 1),
            'TU_KHOA' => $this->query('TU_KHOA', null),
            'TRANG_THAI_GIAO_DICH' => $this->query('TRANG_THAI_GIAO_DICH', null),
        ]);
    }

    public function rules(): array
    {
        return [
            'TRANG_THAI_GIAO_DICH' => [
                'bail',
                'nullable',
                'string',
            ],
        ];
    }

    public function messages()
    {
        $locale = app()->getLocale();
        $messages = json_decode(file_get_contents(resource_path("lang/{$locale}/validation.json")), true);
        $messagesForThisRequest = json_decode(file_get_contents(resource_path("lang/{$locale}/transaction/validation.json")), true) ?? [];

        return array_merge($messages, $messagesForThisRequest);
    }

    public function attributes()
    {
        $locale = app()->getLocale();
        $attributes = json_decode(file_get_contents(resource_path("lang/{$locale}/transaction/attributes.json")), true) ?? [];

        return array_merge($attributes, [
            'other' => $this->ID ?? null,
        ]);
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new BadRequestException($validator->errors()->first());
    }
}
