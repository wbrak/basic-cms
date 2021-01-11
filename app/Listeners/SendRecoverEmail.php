<?php

namespace App\Listeners;

use App\Events\UserRecoverPassword;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class SendRecoverEmail
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
     * @param  UserRecoverPassword  $event
     * @return void
     */
    public function handle(UserRecoverPassword $event)
    {
        //send the recover email to the user
        $user = $event->user;
        Mail::send('emails.recoverPassword', ['user' => $user], function ($message) use ($user) {
            $message->from('webmasterbrak@gmail.com', Lang::get('Name Employee'));
            $message->subject(Lang::get('Recover password ').Config::get('company.name').' '.' !');
            $message->to($user->email);
        });
    }
}
