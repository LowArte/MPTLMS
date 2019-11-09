<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AnswerForRequest extends Notification
{
    use Queueable;
    public $message;
    public $email;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message,$email)
    {
        $this->message = $message;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->markdown('vendor.notifications.answerforrequest',["message"=>$this->message,"email"=>$this->email])
        ->from('p_a.n.pikalov@mpt.ru',"Ответ на обращение")
        ->subject('Ответ на обращение от: ' . config('app.name'))
        ->line('По ващему обрещение связанному с возникщей ошибкой, был отпревлен ответ администратора:')
        ->line($this->message)
        ->line("Спасибо за ваще обращение");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
