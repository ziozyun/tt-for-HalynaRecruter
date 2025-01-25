<?php

namespace App\Providers;

use App\Models\Task;
use App\Observers\TaskObserver;
use App\Services\GoogleSheetService;
use App\Services\TelegramService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TelegramService::class, function () {
            $token = config('telegram.token');
            return new TelegramService($token);
        });

        $this->app->singleton(GoogleSheetService::class, function () {
            $accessToken = config('google_sheet.access_token');
            return new GoogleSheetService($accessToken);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Task::observe(TaskObserver::class);
    }
}
