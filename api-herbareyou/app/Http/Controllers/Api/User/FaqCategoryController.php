<?php

namespace App\Http\Controllers\Api\User;

use App\Domains\FaqDomain;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FaqCategoryController extends BaseController
{
    private $faqDomain;

    public function __construct(
        FaqDomain $faqDomain
    ) {
        parent::__construct();
        $this->faqDomain = $faqDomain;
    }

    public function index(Request $request): JsonResponse
    {
        $allFaqCategories = $this->faqDomain->getAllFaqCategories();
        $allFaqCategories->load(['faqs']);
        return $this->sendResponse(
            $allFaqCategories
        );
    }
}
