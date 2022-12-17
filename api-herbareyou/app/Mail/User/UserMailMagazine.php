<?php

namespace App\Mail\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserMailMagazine extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $user;
    public $subject;
    public $body;

    public function __construct(
        User $user,
        string $subject,
        string $body
    ) {
        $this->user = $user;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailData = config('mails.user.mail_magazine');
        return $this
            ->view($mailData['body'])
            // ->from($mailData['from'])
            ->subject($this->subject)
            ->with([
                'user' => $this->user,
                'body' => $this->body,
            ]);
    }
}
