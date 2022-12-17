<?php

namespace App\Domains;

// use Illuminate\Filesystem\FilesystemAdapter;
use App\Enums\IsConfirm;
use App\Models\UploadFile;
use Illuminate\Support\Facades\Storage;

class UploadFileDomain extends BaseDomain
{
    private $uploadFile;
    public function __construct(
        UploadFile $uploadFile
    ) {
        $this->uploadFile = $uploadFile;
    }

    public function createUploadFile(string $fileName, ?string $filePath): ?UploadFile
    {
        $uploadFile = new UploadFile();
        if (!$filePath) {
            $uploadFile->file_path = $this->getUploadFilePath($fileName);
        } else {
            $uploadFile->file_path = config('aws.s3_path') . $filePath;
        }
        $uploadFile->file_name = $fileName;
        $uploadFile->saveOrFail();
        $uploadFile->hash = $this->getHash($uploadFile->id);
        $uploadFile->saveOrFail();
        return $uploadFile;
    }

    public function updateUploadFileConfirmById(int $id): void
    {
        $uploadFile = $this->uploadFile->find($id);
        $file = app()->make('s3')->getObject(config('aws.s3_default_bucket'), $uploadFile->file_path);
        $uploadFile->is_confirm = IsConfirm::IS_CONFIRM;
        $uploadFile->size = $file['ContentLength'];
        $uploadFile->mime_type = $file['ContentType'];
        $uploadFile->save();
    }

    public function getUploadFileById(int $id): ?UploadFile
    {
        return $this->uploadFile->find($id);
    }


    public function getUploadFileByHash(string $hash): ?UploadFile
    {
        return $this->uploadFile
                ->where('hash', $hash)
                ->first();
    }

    private function getUploadFilePath(string $fileName): string
    {
        return config('aws.s3_uploads_path') . date("Y/m/d/") . uniqid() . uniqid() . '.' . $this->getExt($fileName);
    }

    private function getExt(string $filePath): string
    {
        return pathinfo($filePath)['extension'];
    }

    private function getHash(string $text): string
    {
        return uniqid($text) . uniqid($text);
    }

    public function getFileSize(string $filePath): string
    {
        return Storage::disk(config('const.STORAGE_KIND'))->size($filePath);
    }

    public function getMimeType(string $filePath): string
    {
        return Storage::disk(config('const.STORAGE_KIND'))->mimeType($filePath);
    }

    private function getSearchQuery($query, array $search)
    {
        if (isset($search['file_type_csv'])) {
            $fileTypeArray = explode(',', $search['file_type_csv']);
            $query = $query->whereIn('file_type', $fileTypeArray);
        }
        if (isset($search['order_by'])) {
            $query = $query->orderBy($search['order_by']);
        } elseif (isset($search['order_by_raw'])) {
            $query = $query->orderByRaw($search['order_by_raw']);
        } else {
            $query = $query->orderBy('id');
        }
        return $query;
    }

    public function getUploadFileList(array $search = [])
    {
        $perPage = $this->getPerPage($search);
        $query = $this->uploadFile;
        return $perPage !== -1
            ? $this->getSearchQuery($query, $search)
                ->paginate($perPage)
            : $this->getSearchQuery($query, $search)
                ->get();
    }

    public function existConfirm(UploadFile $uploadFile): bool
    {
        if ($uploadFile === null || $uploadFile->is_confirm !== IsConfirm::IS_NOT_CONFIRM) {
            return false;
        }
        return app()
            ->make('s3')
            ->getS3Client()
            ->doesObjectExist(config('aws.s3_default_bucket'), $uploadFile->file_path);
    }
}
