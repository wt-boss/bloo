<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageRated extends Notification
{
    use Queueable;

    protected $message;
    protected $receiver_id;
    protected $user_id;

    /**
     * Create a new notification instance.
     *
     * @param $message
     * @param $receiver_id
     * @param $user_id
     */
    public function __construct($message, $receiver_id, $user_id)
    {
        $this->message = $message;
        $this->receiver_id = $receiver_id;
        $this->user_id = $user_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public function toArray()
    {
        return [
            'message' => $this->message,
            'receiver_id' => (integer)$this->receiver_id,
            'user' => (integer)$this->user_id
        ];
    }

}
