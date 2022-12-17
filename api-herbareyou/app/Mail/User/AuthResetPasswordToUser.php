<?php

namespace App\Mail\User;

use App\Models\User;
use App\Models\UserResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthResetPasswordToUser extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $userRow;
    public $userResetPaswordRow;

    public function __construct(
        User $userRow,
        UserResetPassword $userResetPaswordRow
    ) {
        $this->userRow = $userRow;
        $this->userResetPaswordRow = $userResetPaswordRow;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailData = config('mails.user.auth_reset_password');
        return $this
            // ->from($mailData['from'])
            ->subject($mailData['subject'])
            ->text($mailData['body']);
    }
}
