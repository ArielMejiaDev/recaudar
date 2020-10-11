<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserTeamInvitation extends Notification
{
    use Queueable;

    public string $email;
    public string $generatedPassword;
    public string $teamName;

    /**
     * Create a new notification instance.
     *
     * @param string $email
     * @param string $generatedPassword
     * @param string $teamName
     */
    public function __construct(string $email, string $teamName, string $generatedPassword)
    {
        $this->email = $email;
        $this->teamName = $teamName;
        $this->generatedPassword = $generatedPassword;
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
            ->subject(trans('You have been invited to a work with') . ' ' . $this->teamName )
            ->greeting(  trans('You have been invited to a work with') . ' ' . $this->teamName )
            ->line(trans('Your credentials are') . ':')
            ->line(trans('Email') . ': ' . $this->email)
            ->line(trans('Password') . ': ' . $this->generatedPassword)
            ->action(trans('Login'), route('profile.show'))
            ->line(trans('You can change your password as soon as you are login.'));
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
