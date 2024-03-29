<?php

namespace App\Events;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AccountCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user, $password;
    /**
     * Create a new event instance.
     */
    public function __construct(Admin $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }
}
