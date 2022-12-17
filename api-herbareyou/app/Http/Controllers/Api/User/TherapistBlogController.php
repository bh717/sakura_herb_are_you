<?php

namespace App\Http\Controllers\Api\User;

use App\Domains\TherapistDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Adminer\TherapistCollection;
use App\Http\Resources\Adminer\TherapistResource;
use Illuminate\Http\Request;

class TherapistBlogController extends BaseController
{
    private $therapistDomain;

    public function __construct(
        TherapistDomain $therapistDomain
    ) {
        parent::__construct();
        $this->therapistDomain = $therapistDomain;
    }

    public function index(Request $request): TherapistCollection
    {
        $allPublicBlogs = $this->therapistDomain->getAllPublicBlogs();
        $allPublicBlogs->loadMissing(['therapist', 'uploadFiles']);
        return new TherapistCollection($allPublicBlogs);
    }

    public function show(Request $request, int $id): TherapistResource
    {
        $publicTherapistBlog = $this->therapistDomain->getPublicBlogById($id);
        if (is_null($publicTherapistBlog)) {
            return $this->send404ErrorResponse();
        }
        $publicTherapistBlog->loadMissing(['therapist', 'uploadFiles']);
        $publicTherapistBlog->next_blog = $this->therapistDomain->getNextPublicBlogById($publicTherapistBlog->id);
        return new TherapistResource($publicTherapistBlog);
    }
}
