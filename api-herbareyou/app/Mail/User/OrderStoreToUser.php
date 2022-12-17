<?php

namespace App\Mail\User;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\UserDeliveryLocation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStoreToUser extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $orderId;
    public $order;
    public $orderDetails;
    public $user;
    public $userDeliveryLocation;

    public function __construct(
        int $orderId
    ) {
        $this->orderId = $orderId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->order = Order::find($this->orderId);
        $this->orderDetails = OrderDetail::with(['product', 'productPrice'])
            ->where('order_id', $this->order->id)
            ->get();
        $this->user = User::find($this->order->user_id);
        $this->userDeliveryLocation = UserDeliveryLocation::where('user_id', $this->order->user_id)->first();
        $mailData = config('mails.user.order_store');
        return $this
            // ->from($mailData['from'])
            ->subject($mailData['subject'])
            ->text($mailData['body']);
    }
}
