<?php

namespace App\Observers;

use App\Events\GoogleSheetTaskUpdate;
use App\Events\TelegramTaskNotification;
use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        event(new TelegramTaskNotification($task));
        event(new GoogleSheetTaskUpdate($task));
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        //
    }
}
