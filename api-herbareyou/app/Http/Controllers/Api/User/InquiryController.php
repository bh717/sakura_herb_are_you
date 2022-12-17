<?php

namespace App\Http\Controllers\Api\User;

use App\Domains\InquiryDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\User\InquiryStoreRequest;
use App\Mail\Adminer\InquiryStoreToAdminer;
use App\Mail\User\InquiryStoreToUser;
use Illuminate\Http\JsonResponse;
use Mail;

class InquiryController extends BaseController
{
    private $inquiryDomain;

    public function __construct(
        InquiryDomain $inquiryDomain
    ) {
        parent::__construct();
        $this->inquiryDomain = $inquiryDomain;
    }

    public function store(InquiryStoreRequest $request): JsonResponse
    {
        $inquiry = $this->inquiryDomain->createInquiry($request->validated());
        Mail::to($request->email)->send(new InquiryStoreToUser($inquiry));
        Mail::to(config('consts.ADMINER_EMAIL'))->send(new InquiryStoreToAdminer($inquiry));
        return $this->sendResponse($inquiry);
    }
}
