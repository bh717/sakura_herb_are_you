<?php

namespace App\Mail\User;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryStoreToUser extends Mailable
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
        $mailData = config('mails.user.inquiry_store');
        return $this
            // ->from($mailData['from'])
            ->subject($mailData['subject'])
            ->text($mailData['body']);
    }
}
