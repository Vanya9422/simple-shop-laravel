<?php

namespace App\Listeners;

use App\Events\OrderConfirmedBySeller;
use App\Mail\SellerConfirmationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSellerConfirmationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderConfirmedBySeller  $event
     * @return void
     */
    public function handle(OrderConfirmedBySeller $event)
    {
        \Mail::to($event->order->email)->send(
            new SellerConfirmationEmail($event->seller,  $event->order)
        );
    }
}
