<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Domains\FaqDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\FaqCategoryStoreRequest;
use App\Http\Requests\Api\Adminer\FaqCategoryUpdateRequest;
use App\Models\FaqCategory;
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

    public function store(FaqCategoryStoreRequest $request): JsonResponse
    {
        $faqCategory = $this->faqDomain->createFaqCategory($request->name);
        return $this->sendResponse($faqCategory);
    }

    public function index(Request $request): JsonResponse
    {
        return $this->sendResponse(
            $this->faqDomain->getAllFaqCategories()
        );
    }

    public function show(Request $request, FaqCategory $faqCategory): JsonResponse
    {
        return $this->sendResponse($faqCategory);
    }

    public function update(FaqCategoryUpdateRequest $request, FaqCategory $faqCategory): JsonResponse
    {
        $faqCategory = $this->faqDomain->updateFaqCategory($faqCategory->id, $request->name);
        return $this->sendResponse($faqCategory);
    }

    public function destroy(Request $request, FaqCategory $faqCategory): JsonResponse
    {
        $this->faqDomain->deleteFaqCategory($faqCategory->id);
        return $this->sendResponse(null, 204);
    }
}
