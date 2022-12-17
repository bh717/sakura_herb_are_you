<?php

namespace App\Mail\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderAfterMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $recommendationProducts;
    public $user;

    public function __construct(
        User $user,
        Collection $recommendationProducts
    ) {
        $this->user = $user;
        $this->recommendationProducts = $recommendationProducts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailData = config('mails.user.order_after_mail');
        return $this
            ->view($mailData['body'])
            // ->from($mailData['from'])
            ->subject($mailData['subject'])
            ->with([
                'user' => $this->user,
                'recommendationProducts' => $this->recommendationProducts,
            ]);
    }
}
