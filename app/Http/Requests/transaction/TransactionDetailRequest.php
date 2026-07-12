<?php

namespace App\Http\Requests\transaction;

use App\Enum\AppConstant;
use App\Enum\PermissionEnum;
use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Rules\CheckNotExistsFieldRule;
use Illuminate\Foundation\Http\FormRequest;

class TransactionDetailRequest extends FormRequest
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
        $allowed = [
            PermissionEnum::QL_DON_HANG_XEM->value,
            PermissionEnum::QL_DON_HANG_CHI_TIET->value,
            PermissionEnum::QL_DON_HANG_DANH_SACH->value,
        ];
        foreach ($permissions as $permission) {
            if (in_array($permission->CODE, $allowed, true)) {
                return true;
            }
        }

        return false;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'ID' => $this->route('ID'),
        ]);
    }

    public function rules(): array
    {
        return [
            'ID' => [
                'bail',
                'required',
                'integer',
                new CheckNotExistsFieldRule('transaction', 'ID', $this->route('ID'), 'USING'),
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
            'other' => $this->ID,
        ]);
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $idFailedRules = $validator->failed()['ID'] ?? [];
        if (! empty($idFailedRules)) {
            $collectionIdFailedRules = collect($idFailedRules);
            $idFailedRuleNotFound = $collectionIdFailedRules->filter(function ($value, $key) {
                return $key == CheckNotExistsFieldRule::class;
            });
            if ($idFailedRuleNotFound->isNotEmpty()) {
                throw new NotFoundException($validator->errors(), 'Đơn hàng không tồn tại.');
            }
        }

        throw new BadRequestException($validator->errors(), 'Truy vấn thất bại.');
    }
}
