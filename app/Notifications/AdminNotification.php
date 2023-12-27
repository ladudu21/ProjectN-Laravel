<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class AdminNotification extends Notification
{
    use Queueable;

    private $user;
    private $message;

    /**
     * Create a new notification instance.
     */
    public function __construct($message)
    {
        $this->user = Auth::user();
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [DatabaseChannel::class, 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'from' => $this->user->name,
            'message' => $this->message
        ]);
    }

    public function toDatabase(object $notifiable)
    {
        return [
            'from' => $this->user->name,
            'message' => $this->message,
            'message_id' => time() . $this->user->id
        ];
    }
}
