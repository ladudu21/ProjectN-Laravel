<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class DatabaseChannel extends Notification
{
    public function send($notifiable, AdminNotification $notification)
    {
        $data = $notification->toDatabase($notifiable);

        $message_id = $data['message_id'];
        unset($data['message_id']);

        return $notifiable->routeNotificationFor('database')->create([
            'id' => $notification->id,
            'notifiable_type' => \Auth::user()->id,
            'type' => get_class($notification),
            'data' => $data,
            'message_id' => $message_id,
            'read_at' => null,
        ]);
    }
}
