<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class CheckNotExistsFieldRule implements ValidationRule
{
    /* Tên bảng */
    protected $tableName;

    /* Tên trường */
    protected $fieldName;

    /* Giá trị của trường */
    protected $fieldValue;

    /* Trạng thái */
    protected $status;

    /**
     * Sql check Exists field
     * 
     * @return boolean
     */
    protected function sqlCheckExistsField()
    {
        $conditions = [
            $this->fieldName => $this->fieldValue,
            'STATUS' => $this->status
        ];

        $exists = DB::table($this->tableName)
            ->where($conditions)
            ->exists();
        return (bool) !$exists;
    }

    /**
     * Khởi tạo các biến
     * 
     * @param Tên table $tableName
     * @param Tên field $fieldName
     * @param Giá trị field $fieldValue
     * @param Trạng thái $status
     */
    public function __construct($tableName, $fieldName, $fieldValue, $status)
    {
        $this->tableName = $tableName;

        $this->fieldName = $fieldName;
        $this->fieldValue = $fieldValue;

        $this->status = $status;
    }

    /**
     * Validate
     * 
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Validation\ValidationRule::validate()
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->sqlCheckExistsField()) {
            $locale = app()->getLocale();
            $messages = json_decode(file_get_contents(resource_path("lang/{$locale}/validation.json")), true);
            $fail($messages['does_not_exists'] ?? ':attribute không tồn tại.');
        }
    }
}
