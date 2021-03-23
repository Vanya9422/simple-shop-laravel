<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellerConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    public $seller;

    /**
     * @var User
     */
    public $order;

    /**
     * Create a new message instance.
     *
     * @param $seller
     * @param Order $order
     */
    public function __construct($seller, Order $order)
    {
        $this->seller = $seller;
        $this->order = $order;
    }

    /**w
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.seller-confirmation');
    }
}
