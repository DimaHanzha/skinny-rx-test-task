<?php

namespace App\Providers;

use App\Events\SubmissionSaved;
use App\Listeners\SubmissionNotification;
use App\Services\Submission;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            SubmissionSaved::class,
            SubmissionNotification::class,
        );
    }
}
