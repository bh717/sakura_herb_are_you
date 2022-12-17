<?php

namespace App\Domains;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Database\Eloquent\Collection;

class FaqDomain extends BaseDomain
{
    private $faq;
    private $faqCatgoery;

    public function __construct(
        Faq $faq,
        FaqCategory $faqCatgoery
    ) {
        $this->faq = $faq;
        $this->faqCatgoery = $faqCatgoery;
    }

    public function createFaq(
        int $faqCategoryId,
        string $title,
        string $body
    ): Faq {
        $faq = new Faq();
        $faq->faq_category_id = $faqCategoryId;
        $faq->title = $title;
        $faq->body = $body;
        $faq->saveOrFail();
        return $faq;
    }

    public function updateFaq(
        int $id,
        int $faqCategoryId,
        string $title,
        string $body
    ): Faq {
        $faq = $this->faq->find($id);
        $faq->faq_category_id = $faqCategoryId;
        $faq->title = $title;
        $faq->body = $body;
        $faq->saveOrFail();
        return $faq;
    }

    public function deleteFaq(
        int $fawId
    ): void {
        $this->faq->destroy($fawId);
    }

    public function getAllFaqs(): Collection
    {
        return $this->faq->orderBy('id')->get();
    }

    public function createFaqCategory(
        string $name
    ): FaqCategory {
        $faqCategory = new FaqCategory();
        $faqCategory->name = $name;
        $faqCategory->saveOrFail();
        return $faqCategory;
    }

    public function updateFaqCategory(
        int $categoryId,
        string $name
    ): FaqCategory {
        $faqCategory = $this->faqCatgoery->find($categoryId);
        $faqCategory->name = $name;
        $faqCategory->saveOrFail();
        return $faqCategory;
    }

    public function deleteFaqCategory(
        int $categoryId
    ): void {
        $this->faqCatgoery->destroy($categoryId);
    }

    public function getAllFaqCategories(): Collection
    {
        return $this->faqCatgoery->orderBy('id')->get();
    }
}
