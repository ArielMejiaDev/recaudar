<?php

namespace App\Notifications;

use App\Models\Team;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTeamCreatedNotification extends Notification
{
    use Queueable;

    public $team;
    /**
     * @var User
     */
    public $user;

    /**
     * Create a new notification instance.
     *
     * @param Team $team
     * @param User $user
     */
    public function __construct(Team $team, User $user)
    {

        $this->team = $team;
        $this->user = $user;
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
            ->greeting(trans('There is a new team created.'))
            ->line($this->team->name)
            ->line(trans('Created by') . ': ' . $this->user->name . ', ' . 'Email' . ': ' . $this->user->email)
            ->action(trans('Go to the app.'), url('/'))
            ->line(trans('Thank you for attending the notifications of the application.'));
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
