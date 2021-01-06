<?php

namespace App\Mail;

use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

/**
 * Class EventNotification
 * @package App\Mail
 */
class EventNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $userName;

    /**
     * Create a new message instance.
     *
     * @param $event
     */
    public function __construct($event, $userName)
    {
        $this->event = $event;
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
            ->subject('Notificación (nuevo evento) MIS EVENTOS CERCANOS')
            ->view('emails.event_notification');
    }
}
