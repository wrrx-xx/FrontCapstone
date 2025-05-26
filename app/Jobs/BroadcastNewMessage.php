<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Pusher\Pusher;

class BroadcastNewMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $messageArr;

    /**
     * Create a new job instance.
     *
     * @param array $messageArr
     * @return void
     */
    public function __construct(array $messageArr)
    {
        $this->messageArr = $messageArr;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            config('broadcasting.connections.pusher.options')
        );

        $pusher->trigger('chat-channel', 'new-message', $this->messageArr);
    }
}
