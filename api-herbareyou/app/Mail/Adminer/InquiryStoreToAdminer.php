<?php

namespace App\Mail\Adminer;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryStoreToAdminer extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $inquiry;

    public function __construct(
        Inquiry $inquiry
    ) {
        $this->inquiry = $inquiry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailData = config('mails.adminer.inquiry_store');
        return $this
            // ->from($mailData['from'])
            ->subject($mailData['subject'])
            ->text($mailData['body']);
    }
}
