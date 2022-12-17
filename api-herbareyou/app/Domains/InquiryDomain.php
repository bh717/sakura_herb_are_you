<?php

namespace App\Domains;

use App\Models\Inquiry;
use Illuminate\Database\Eloquent\Collection;

class InquiryDomain extends BaseDomain
{
    private $inquiry;

    public function __construct(
        Inquiry $inquiry
    ) {
        $this->inquiry = $inquiry;
    }

    public function createInquiry(array $data): Inquiry
    {
        return $this->inquiry->create($data);
    }

    public function getInquiryById(int $id): ?Inquiry
    {
        return $this->inquiry->find($id);
    }

    public function getAllInquiries(): Collection
    {
        return $this->inquiry->get();
    }

    public function updateInquiryStatusById(int $id, int $status): bool
    {
        return $this->getInquiryById($id)->update([
            'status' => $status,
        ]);
    }
}
