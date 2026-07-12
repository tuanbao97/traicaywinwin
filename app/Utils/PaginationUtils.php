<?php

namespace App\Utils;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PaginationUtils
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function pagination(LengthAwarePaginator $pagination) {
        $customResponsePagination = [
            'DATA' => $pagination->getCollection()
            , 'CURRENT_PAGE' => $pagination->currentPage()
            , 'TOTAL_ITEM' => $pagination->total()
            , 'PER_PAGE' => $pagination->perPage()
            , 'TOTAL_PAGE' => $pagination->lastPage()
            , 'LINKS' => [
                'FIRST' => $pagination->url(1)
                , 'LAST' => $pagination->url($pagination->lastPage())
                , 'NEXT' => $pagination->nextPageUrl()
                , 'PREVIOUS' => $pagination->previousPageUrl()
            ]
        ];
        return $customResponsePagination;
    }

}
