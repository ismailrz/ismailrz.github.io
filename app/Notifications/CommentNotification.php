<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class CommentNotification extends Notification
{
    use Queueable;
    public $user;

    public function __construct(User $from)
    {
        $this->user = $from;
    }


    public function via($notifiable)
    {
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->line('The introduction to the notification.')
        ->action('Notification Action', url('/'))
        ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'id'=> $this->user->id,
            'name' => $this->user->name,
            'profile_picture' => $this->user->profile_picture,
            'type' => $this->user->notification_type,
            'type_id' => $this->user->type_id
        ];
    }
}
