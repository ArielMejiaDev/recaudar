<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExistingUserTeamInvitation extends Notification
{
    use Queueable;

    public string $email;
    public string $teamName;

    /**
     * Create a new notification instance.
     *
     * @param string $email
     * @param string $teamName
     */
    public function __construct(string $email, string $teamName)
    {
        $this->email = $email;
        $this->teamName = $teamName;
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
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('You have been invited to a work with ' . $this->teamName  .' in ' . config('app.name') )
            ->greeting('Hi you are invited to work with ' . $this->teamName )
            ->line('You can access with your email: ' . $this->email)
            ->action('Login', route('login'));
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
