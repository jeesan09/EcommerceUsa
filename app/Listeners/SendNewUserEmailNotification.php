<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserNotification;

class SendNewUserEmailNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(NewUserRegistered $event)
    {
        // Retrieve the new user from the event
        $user = $event->user;
        /* dd($user->email); */
        // Send an email notification to the admin
        Mail::to('sales@megaphonewholesale.com')->send(new NewUserNotification($user));
    }
}
