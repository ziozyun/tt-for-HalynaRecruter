<?php

namespace App\Listeners;

use App\Events\GoogleSheetTaskUpdate;
use App\Services\GoogleSheetService;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleGoogleSheetTaskUpdate implements ShouldQueue
{
    private $googleSheetService;

    /**
     * Create the event listener.
     */
    public function __construct(GoogleSheetService $googleSheetService)
    {
        $this->googleSheetService = $googleSheetService;
    }

    /**
     * Handle the event.
     */
    public function handle(GoogleSheetTaskUpdate $event): void
    {
        $spreadsheetId = config('google_sheet.spreadsheet_id');
        $range = config('google_sheet.range');
        $values = [
            $event->task->id,
            $event->task->title,
            $event->task->description,
            $event->task->user->name,
        ];

        $this->googleSheetService->appendRow($values, $spreadsheetId, $range);
    }
}
