<?php

namespace App\Events;

use App\Models\Remark;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class RemarkCreated implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $remark;

    public function __construct(Remark $remark)
    {
        $this->remark = $remark->load('user');
    }

    public function broadcastOn(): Channel
    {
        return new Channel('remarks');
    }

    public function broadcastAs(): string
    {
        return 'remark.created';
    }
}