<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NotifyFollow extends Notification
{
    use Queueable;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
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
        return ['database','broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'date' => Carbon::now(),
            'message' => 'Comenzo a seguirte!',
            'user' => $this->user,
        ]);
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Comenzo a seguirte!',
            'user' => $this->user,
        ];
    }
}
