<?php

namespace App\Service\impl;

use App\Dto\response\ApiResponseDto;
use App\Enum\AppConstant;
use App\Models\Title;
use App\Repository\TitleRepository;
use App\Service\TitleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TitleServiceImpl implements TitleService
{
    // Inject beans
    private TitleRepository $titleRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(TitleRepository $titleRepository)
    {
        $this->titleRepository = $titleRepository;
    }

    public function getTilteActiveByUserId(int $userId) : ?Title {
        return $this->titleRepository->getTilteActiveByUserId($userId);
    }
    
}
