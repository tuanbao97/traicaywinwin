<?php

namespace App\Http\Requests\transaction;

use App\Enum\PermissionEnum;
use App\Enum\TransactionStatusEnum;
use App\Exceptions\BadRequestException;
use App\Rules\CheckNotExistsFieldRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionUpdateStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        $currUser = $this->user();
        $permissions = $currUser->PERMISSIONS;
        foreach ($permissions as $permission) {
            if ($permission->CODE === PermissionEnum::QL_DON_HANG_CHINH_SUA->value) {
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
            'TRANSACTION_STATUS' => [
                'bail',
                'required',
                'string',
                Rule::in(array_column(TransactionStatusEnum::cases(), 'value')),
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
        throw new BadRequestException($validator->errors()->first());
    }
}
