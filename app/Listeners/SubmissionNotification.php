<?php

namespace App\Listeners;

use App\Events\SubmissionSaved;
use Illuminate\Support\Facades\Log;

class SubmissionNotification
{
    /**
     * Handle the event.
     */
    public function handle(SubmissionSaved $event): void
    {
        Log::info(
            'Successfully saved submission for user: {name}, with email: {email}',
            [
                'name'  => $event->submission->name,
                'email' => $event->submission->email,
            ],
        );
    }
}
