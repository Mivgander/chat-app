<?php

namespace App\Events;

use App\Models\Wiadomosc;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NowaWiadomosc implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $wiadomosc;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Wiadomosc $wiadomosc)
    {
        $this->wiadomosc = $wiadomosc;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('rozmowa.'.$this->wiadomosc->rozmowa_id);
    }

    // public function broadcastAs()
    // {
    //     return 'nowaWiadomosc';
    // }
}
