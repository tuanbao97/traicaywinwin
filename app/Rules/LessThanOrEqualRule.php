<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LessThanOrEqualRule implements ValidationRule
{
    private $otherFieldValue;
    private $otherFieldName;
    private $entity;

    public function __construct($otherFieldValue, $otherFieldName = 'other', $entity)
    {
        $this->otherFieldValue = $otherFieldValue;
        $this->otherFieldName = $otherFieldName;
        $this->entity = $entity;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value > $this->otherFieldValue) {
            $locale = app()->getLocale();
            $messages = json_decode(file_get_contents(resource_path("lang/{$locale}/validation.json")), true);
            $attributes = json_decode(file_get_contents(resource_path("lang/{$locale}/{$this->entity}/attributes.json")), true);

            // Lấy tên hiển thị từ `attributes.json`
             $otherDisplayName = $attributes[$this->otherFieldName] ?? $this->otherFieldName;

            // Lấy thông điệp từ JSON
            $messageTemplate = $messages['less_than_or_equal'];

            // Chuẩn bị thông điệp với giá trị `:other`
            $message = str_replace(':other', $otherDisplayName, $messageTemplate);

            // Gọi `fail` với thông điệp cuối cùng
            $fail($message);
        }
    }
}