<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\title\TitleListRequest;
use App\Service\TitleService;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    // Inject bean
    private TitleService $titleService;

    public function __construct(TitleService $titleService) {
        $this->titleService = $titleService;
    }

}
