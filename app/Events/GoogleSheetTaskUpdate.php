<?php

namespace App\Events;

use App\Models\Task;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GoogleSheetTaskUpdate implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    public $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }
}
