<?php

namespace App\Listeners;

use App\Events\WelcomeMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUser implements ShouldQueue
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
        /* $emailData = [
            'subject' => 'Welcome to E-commerce store',
            'body' => 'Welcome to E-commerce store',
            'tagline' => 'Buy anyone products its reginable price'
        ]; */
        // $users = User::all();
        // foreach ($users as $user) {
        Mail::raw("Hey '{$event->user->firstName} {$event->user->lastName}', check out your product", function ($message) use ($event) {
            $message->to($event->user->email)
                ->subject("Welcome to E-commerce store");
        });
        // }
    }
}
