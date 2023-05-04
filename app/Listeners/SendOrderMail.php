<?php

namespace App\Listeners;

use App\Events\OrderConfirmation;
use App\Mail\OrderMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderMail
{
    public function __construct()
    {
        //
    }

    public function handle(OrderConfirmation $event)
    {
        Mail::to($event->order->email)->send(new OrderMail($event->order));
    }
}
