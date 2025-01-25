<?php

namespace App\Listeners;

use App\Events\TelegramTaskNotification;
use App\Services\TelegramService;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleTelegramTaskNotification implements ShouldQueue
{
    private $telegramService;

    /**
     * Create the event listener.
     */
    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    /**
     * Handle the event.
     */
    public function handle(TelegramTaskNotification $event): void
    {

        $chatId = config('telegram.chat_id');
        $message = "🎉 <b>Нова задача створена!</b> 🎯\n\n" .
            "🆔 <i>ID:</i> {$event->task->id}\n" .
            "📋 <i>Заголовок:</i> {$event->task->title}\n" .
            "👤 <i>Автор:</i> {$event->task->user->name}";

        $this->telegramService->sendMessage($chatId, $message);
    }
}
