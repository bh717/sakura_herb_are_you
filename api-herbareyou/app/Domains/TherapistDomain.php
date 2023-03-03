<?php

namespace App\Domains;

use App\Enums\IsPublic;
use App\Models\Therapist;
use App\Models\TherapistBlog;
use App\Models\UploadFile;
use Illuminate\Database\Eloquent\Collection;

class TherapistDomain extends BaseDomain
{
    private $therapist;
    private $therapistBlog;
    private $uploadFile;

    public function __construct(
        Therapist $therapist,
        TherapistBlog $therapistBlog,
        UploadFile $uploadFile
    ) {
        $this->therapist = $therapist;
        $this->therapistBlog = $therapistBlog;
        $this->uploadFile = $uploadFile;
    }

    public function createTherapist(array $data): Therapist
    {
        $therapist = new Therapist();
        $therapist->name = $data['name'];
        $therapist->name_kana = $data['name_kana'];
        $therapist->profile = $data['profile'];
        $therapist->saveOrFail();
        return $therapist;
    }

    public function getTherapistById(int $id): ?Therapist
    {
        return $this->therapist->find($id);
    }

    public function getAllTherapists(): Collection
    {
        return $this->therapist->get();
    }

    public function updateTherapistById(int $id, array $data): bool
    {
        return $this->getTherapistById($id)->update($data);
    }

    public function deleteTherapistById(int $id): void
    {
        $this->getTherapistById($id)->delete();
        $this->therapistBlog->where('therapist_id', $id)->delete();
    }

    public function createBlog(array $data): TherapistBlog
    {
        $therapistBlog = new TherapistBlog();
        $therapistBlog->therapist_id = $data['therapist_id'];
        $therapistBlog->title = $data['title'];
        $therapistBlog->body = $data['body'];
        $therapistBlog->is_public = $data['is_public'];
        $therapistBlog->saveOrFail();

        $fileId_array = [];

        foreach ($data['upload_file_hashs'] as $item) {
            $uploadFileIds = $this->uploadFile
                ->where('hash', $item)
                ->pluck('id')
                ->first();

            array_push($fileId_array, $uploadFileIds);
        }

        

        $therapistBlog->uploadFiles()->sync($fileId_array);

        // $uploadFileIds = $this->uploadFile
        //     ->where('hash', $data['upload_file_hashs'])
        //     ->pluck('id')
        //     ->toArray();
        // $therapistBlog->uploadFiles()->sync($uploadFileIds);

        return $therapistBlog;
    }

    public function getBlogById(int $id): ?TherapistBlog
    {
        return $this->therapistBlog->find($id);
    }

    public function getNextPublicBlogById(int $id): ?TherapistBlog
    {
        return $this->therapistBlog
            ->where('id', '>', $id)
            ->where('is_public', IsPublic::IS_PUBLIC)
            ->orderBy('id', 'asc')
            ->first();
    }

    public function getPublicBlogById(int $id): ?TherapistBlog
    {
        return $this->therapistBlog
            ->where('is_public', IsPublic::IS_PUBLIC)
            ->find($id);
    }

    public function getAllPublicBlogs(): Collection
    {
        return $this->therapistBlog
            ->where('is_public', IsPublic::IS_PUBLIC)
            ->get();
    }

    public function getAllBlogs(): Collection
    {
        return $this->therapistBlog->get();
    }

    public function updateBlogById(int $id, array $data): TherapistBlog
    {
        $therapistBlog = $this->therapistBlog->find($id);
        $therapistBlog->title = $data['title'];
        $therapistBlog->body = $data['body'];
        $therapistBlog->is_public = $data['is_public'];
        $therapistBlog->saveOrFail();

        $fileId_array = [];

        foreach ($data['upload_file_hashs'] as $item) {
            $uploadFileIds = $this->uploadFile
                ->where('hash', $item)
                ->pluck('id')
                ->first();

            array_push($fileId_array, $uploadFileIds);
        }

        $therapistBlog->uploadFiles()->sync($fileId_array);

        return $therapistBlog;
    }

    public function deleteBlogById(int $id): void
    {
        $this->therapistBlog->destroy($id);
    }
}
