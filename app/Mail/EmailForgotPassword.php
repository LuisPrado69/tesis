<?php

namespace App\Mail;

use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

/**
 * Class EmailForgotPassword
 * @package App\Mail
 */
class EmailForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;

    /**
     * Create a new message instance.
     *
     * @param $userName
     */
    public function __construct($userName)
    {
        $this->userName = $userName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_ADDRESS'))
            ->subject('Notificación (recuperación de contraseña) MIS EVENTOS CERCANOS')
            ->view('emails.email_forgot_password');
    }
}
