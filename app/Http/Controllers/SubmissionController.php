<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Jobs\ProcessSubmissionJob;
use Illuminate\Http\JsonResponse;

class SubmissionController extends Controller
{
    public function store(SubmissionRequest $request): JsonResponse
    {
        $data = $request->validated();

        ProcessSubmissionJob::dispatch($data);

        return response()->json(
            ['message' => 'Submission received and is being processed.'],
            202,
        );
    }
}
