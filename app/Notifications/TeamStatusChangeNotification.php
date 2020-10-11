<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeamStatusChangeNotification extends Notification
{
    use Queueable;

    public string $teamName;
    public string $status;

    /**
     * Create a new notification instance.
     *
     * @param string $teamName
     * @param string $status
     */
    public function __construct(string $teamName, string $status)
    {
        $this->teamName = $teamName;
        $this->status = $status;
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
        if($this->status === 'approved') {
            return (new MailMessage)
                ->subject(trans('Team Updated'))
                ->greeting(trans('Team Updated'))
                ->line($this->teamName . ' ' . trans('is now') . ' ' . trans(ucfirst($this->status)) . '.')
                ->line(trans('You can enter the application and start receiving donations.'))
                ->action(trans('Login'), route('login'))
                ->salutation(trans('Thanks for using') . ' ' . config('app.name'));
        }
        return (new MailMessage)
            ->subject(trans('Team Updated'))
            ->greeting(trans('Team Updated'))
            ->line($this->teamName . ' ' . trans('is now') . ' ' . trans(ucfirst($this->status)) . '.')
            ->salutation(trans('Thanks for using') . ' ' . config('app.name'));
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
