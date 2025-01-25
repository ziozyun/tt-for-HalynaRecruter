<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Task;

class TelegramTaskNotification implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    public $task;

    /**
     * Create a new event instance.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }
}
