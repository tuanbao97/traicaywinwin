<?php

namespace App\Dto\sort;

use Illuminate\Http\Request;

class SortRequestDto 
{
    public ?string $fieldName = null;
    public ?string $sortType = null;

    public function __construct(array $data = []) {
        $this->fieldName = $data['FIELD_NAME'] ?? null;
        $this->sortType = strtolower($data['SORT_TYPE'] ?? 'asc'); // Mặc định là asc 
    }

    public static function fromRequest(Request $request) : self {
        return new SortRequestDto($request->input('SORT') ?? []);
    }

}
