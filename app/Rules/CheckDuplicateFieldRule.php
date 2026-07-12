<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Closure;
use Illuminate\Support\Facades\Log;

class CheckDuplicateFieldRule implements ValidationRule
{

    /* Tên bảng */
    protected $tableName;

    /* Tên trường */
    protected $fieldName;

    /* Giá trị của trường */
    protected $fieldValue;

    /* Giá trị id của trường đó */
    protected $fieldId;

    /* Trạng thái */
    protected $status;

    /**
     * Sql check duplicate field
     * 
     * @return boolean
     */
    protected function sqlCheckDuplicateField()
    {
        $conditions = [
            [$this->fieldName, '=', $this->fieldValue],
            ['STATUS', '=', $this->status]
        ];

        if (!is_null($this->fieldId)) {
            $conditions[][] = [
                ['ID', '!=', $this->fieldId]
            ];
        }
        Log::info('Sql check duplicate field');
        $existsDuplicate = DB::table($this->tableName)
            ->where($conditions)
            ->exists();
        return (bool) $existsDuplicate;
    }

    /**
     * Khởi tạo các biến
     * 
     * @param Tên table $tableName
     * @param Tên field $fieldName
     * @param Giá trị field $fieldValue
     * @param Trạng thái $status
     */
    public function __construct($tableName, $fieldName, $fieldValue, $status, $fieldId = null)
    {
        $this->tableName = $tableName;

        $this->fieldName = $fieldName;
        $this->fieldValue = $fieldValue;

        $this->status = $status;

        $this->fieldId = $fieldId;
    }

    /**
     * Validate
     * 
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Validation\ValidationRule::validate()
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->sqlCheckDuplicateField()) {
            $locale = app()->getLocale();
            $messages = json_decode(file_get_contents(resource_path("lang/{$locale}/validation.json")), true);
            $fail($messages['data_already_exists'] ?? ':attribute đã tồn tại dữ liệu trước đó.');
        }
    }

    
}
