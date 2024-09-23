<?php

namespace App\Jobs;

use App\Services\Submission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessSubmissionJob implements ShouldQueue
{
    use Queueable;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle(Submission $service)
    {
        try {
            $service->save($this->data);
        } catch (\Exception $e) {
            throw new \Exception('Job failed: ' . $e->getMessage());
        }
    }
}
