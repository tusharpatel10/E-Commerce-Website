<?php

namespace App\Listeners;

use App\Events\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyAdmin implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WelcomeMail $event): void
    {

        $user = $event->user;
        $emailData = [
            "subject" => "Welcome to E-commerce Store",
            "body" => "Welcome to E-commerce online Platform store",
            "tagline" => "This Product has been valid offer only"
        ];

        Mail::raw("A '{$event->user->firstName} {$event->user->lastName}' user it has been Account Created!!", function ($message) {
            $message->to('tusharpatel1093@gmail.com')
                ->subject("Welcome to E-commerce Store");
        });
    }
}
