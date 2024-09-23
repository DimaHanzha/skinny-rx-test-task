<?php

namespace App\Services;

use App\Events\SubmissionSaved;
use App\Models\Submission as SubmissionModel;

class Submission
{
    public function save(array $data): void
    {
        try {
            $submission = SubmissionModel::create($data);

            SubmissionSaved::dispatch($submission);

        } catch (\Exception $e) {
            throw new \Exception('Failed to save submission: ' . $e->getMessage());
        }
    }
}
