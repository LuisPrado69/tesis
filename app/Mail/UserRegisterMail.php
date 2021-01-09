<?php

namespace App\Mail;

use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class UserRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $password;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $password
     */
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_ADDRESS'))
            ->subject('Registro de usuario (MIS EVENTOS CERCANOS)')
            ->view('auth.register');
    }
}
