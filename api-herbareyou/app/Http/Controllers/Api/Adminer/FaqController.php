<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Domains\FaqDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\FaqStoreRequest;
use App\Http\Requests\Api\Adminer\FaqUpdateRequest;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FaqController extends BaseController
{
    private $faqDomain;

    public function __construct(
        FaqDomain $faqDomain
    ) {
        parent::__construct();
        $this->faqDomain = $faqDomain;
    }

    public function store(FaqStoreRequest $request): JsonResponse
    {
        $faq = $this->faqDomain->createFaq(
            $request->faq_category_id,
            $request->title,
            $request->body
        );
        return $this->sendResponse($faq);
    }

    public function index(Request $request, Faq $faq): JsonResponse
    {
        $faqs = $this->faqDomain->getAllFaqs();
        $faqs->load(['category']);
        return $this->sendResponse($faqs);
    }

    public function show(Request $request, Faq $faq): JsonResponse
    {
        $faq->load(['category']);
        return $this->sendResponse($faq);
    }

    public function update(FaqUpdateRequest $request, Faq $faq): JsonResponse
    {
        $faq = $this->faqDomain->updateFaq(
            $faq->id,
            $request->faq_category_id,
            $request->title,
            $request->body
        );
        return $this->sendResponse($faq);
    }

    public function destroy(Request $request, Faq $faq): JsonResponse
    {
        $this->faqDomain->deleteFaq($faq->id);
        return $this->sendResponse(null, 204);
    }
}
