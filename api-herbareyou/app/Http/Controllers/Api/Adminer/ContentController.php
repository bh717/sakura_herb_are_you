<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Domains\ContentDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\ContentStoreRequest;
use Illuminate\Http\JsonResponse;

class ContentController extends BaseController
{
    private $contentDomain;

    public function __construct(
        ContentDomain $contentDomain
    ) {
        parent::__construct();
        $this->contentDomain = $contentDomain;
    }

    public function store(ContentStoreRequest $request): JsonResponse
    {
        $content = $this->contentDomain->getFirstContent($request->kind);
        if (is_null($content)) {
            $newContent = $this->contentDomain->createContent($request->kind, $request->content ?? '');
        } else {
            $newContent = $this->contentDomain->updateContent($content->id, $request->content ?? '');
        }
        return $this->sendResponse($newContent);
    }

    public function firstContent(string $kind): JsonResponse
    {
        return $this->sendResponse(
            $this->contentDomain->getFirstContent($kind)
        );
    }
}
