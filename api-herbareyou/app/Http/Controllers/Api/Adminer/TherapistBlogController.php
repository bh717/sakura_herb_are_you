<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Domains\TherapistDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\TherapistBlogStoreRequest;
use App\Http\Requests\Api\Adminer\TherapistBlogUpdateRequest;
use App\Http\Resources\Adminer\TherapistCollection;
use App\Http\Resources\Adminer\TherapistResource;
use App\Models\TherapistBlog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TherapistBlogController extends BaseController
{
    private $therapistDomain;

    public function __construct(
        TherapistDomain $therapistDomain
    ) {
        parent::__construct();
        $this->therapistDomain = $therapistDomain;
    }                                       

    public function store(TherapistBlogStoreRequest $request): TherapistResource
    {
        Log::debug($request);
        $blog = $this->therapistDomain->createBlog($request->validated());
        $blog->loadMissing(['therapist', 'uploadFiles']);
        return new TherapistResource($blog);
    }

    public function index(Request $request): TherapistCollection
    {
        $blogs = $this->therapistDomain->getAllBlogs();
        $blogs->loadMissing(['therapist', 'uploadFiles']);
        return new TherapistCollection($blogs);
    }

    public function show(Request $request, TherapistBlog $therapistBlog): TherapistResource
    {
        $therapistBlog->loadMissing(['therapist', 'uploadFiles']);
        return new TherapistResource($therapistBlog);
    }

    public function update(TherapistBlogUpdateRequest $request, TherapistBlog $therapistBlog): TherapistResource
    {
        $therapistBlog = $this->therapistDomain->updateBlogById($therapistBlog->id, $request->validated());
        $therapistBlog->loadMissing(['therapist', 'uploadFiles']);
        return new TherapistResource($therapistBlog);
    }

    public function destroy(Request $request, TherapistBlog $therapistBlog): JsonResponse
    {
        $therapistBlog = $this->therapistDomain->deleteBlogById($therapistBlog->id);
        return $this->sendResponse(null, 204);
    }
}
