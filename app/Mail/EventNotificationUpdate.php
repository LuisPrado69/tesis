<?php

namespace App\Mail;

use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

/**
 * Class EventNotificationUpdate
 * @package App\Mail
 */
class EventNotificationUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $userName;

    /**
     * Create a new message instance.
     *
     * @param $event
     * @param $userName
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
            ->subject('Notificación (evento editado) MIS EVENTOS CERCANOS')
            ->view('emails.event_notification_update');
    }
}
