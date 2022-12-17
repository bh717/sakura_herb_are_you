<?php

namespace App\Http\Controllers\Api\User;

use App\Domains\ContentDomain;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContentController extends BaseController
{
    private $contentDomain;

    public function __construct(
        ContentDomain $contentDomain
    ) {
        parent::__construct();
        $this->contentDomain = $contentDomain;
    }

    public function firstContent(Request $request, string $kind): JsonResponse
    {
        return $this->sendResponse(
            $this->contentDomain->getFirstContent($kind)
        );
    }

    public function indexAbout(Request $request)
    {
        return $this->sendResponse(
            $this->contentDomain->getAbout()
        );
    }
}
