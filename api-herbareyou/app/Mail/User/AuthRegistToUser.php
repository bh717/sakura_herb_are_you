<?php

namespace App\Mail\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthRegistToUser extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $user;

    public function __construct(
        User $user
    ) {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailData = config('mails.user.auth_regist');
        return $this
            // ->from($mailData['from'])
            ->subject($mailData['subject'])
            ->text($mailData['body']);
    }
}
