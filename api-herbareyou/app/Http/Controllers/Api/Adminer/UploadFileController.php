<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Domains\UploadFileDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\UploadFileConfirmRequest;
use App\Http\Requests\Api\Adminer\UploadFileGetPreSignedUrlRequest;
use App\Http\Resources\Adminer\UploadFileResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UploadFileController extends BaseController
{
    private $uploadFileDomain;

    public function __construct(
        UploadFileDomain $uploadFileDomain
    ) {
        parent::__construct();
        $this->uploadFileDomain = $uploadFileDomain;
    }

    public function getPreSignedUrl(UploadFileGetPreSignedUrlRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $uploadFile = $this->uploadFileDomain->createUploadFile($request->file_name, $request->file_path);
            $preSignedUrl = app()->make('s3')->createPresignedUrl(
                config('aws.s3_default_bucket'),
                $uploadFile->file_path
            );
            DB::commit();
            return $this->sendResponse([
                'pre_signed_url' => $preSignedUrl,
                'hash' => $uploadFile->hash,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::error($th);
            return $this->send500ErrorResponse();
        }
    }

    public function confirm(UploadFileConfirmRequest $request): UploadFileResource
    {
        $uploadFile = $this->uploadFileDomain->getUploadFileByHash($request->hash);
        if (!$this->uploadFileDomain->existConfirm($uploadFile)) {
            abort(404);
        }
        DB::beginTransaction();
        try {
            $this->uploadFileDomain->updateUploadFileConfirmById($uploadFile->id);
            DB::commit();
            $uploadFile = $this->uploadFileDomain->getUploadFileById($uploadFile->id);
            return new UploadFileResource($uploadFile);
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::error($th);
            throw $th;
        }
    }
}
