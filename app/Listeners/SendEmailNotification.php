<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
//use Illuminate\Auth\Events\Login; //for login...
use App\Services\Mail;

class SendEmailNotification
{

    public $mailer;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->mailer = new Mail;
    }

    /**
     * Handle the event.
     *
     * @param  Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $this->mailer->funcSend('Was registred', $event->user->email);
    }
}
