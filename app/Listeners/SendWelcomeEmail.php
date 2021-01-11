<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
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
     * @param  NewUserRegistered  $event
     * @return void
     */
    public function handle(NewUserRegistered $event)
    {
        //send the welcome email to the user
        $user = $event->user;
        Mail::send('emails.welcome', ['user' => $user], function ($message) use ($user) {
            $message->from('webmasterbrak@gmail.com', Lang::get('Name Employee'));
            $message->subject(Lang::get('Welcome to ').Config::get('company.name').' '.' !');
            $message->to($user->email);
        });
    }
}
