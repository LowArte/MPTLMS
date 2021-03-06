<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Translation\Translator;

class ResetPassword extends ResetPasswordNotification
{
    use Queueable;

    public $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
            ->markdown('vendor.notifications.email')
            ->from('p_a.n.pikalov@mpt.ru', "Востановление пароля")
            ->subject('Восстановление пароля от аккаунта: ' . config('app.name'))
            ->line('По вашему требованию мы выслали ссылку на восстановления пароля. Что бы продолжить нажмите "Восстановить".')
            ->action('Восстановить', url(config('app.url') . route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
            ->line('Если Вы не отправляли запрос на восстановление пароля, проигнорируйте это сообщение.');
    }
}