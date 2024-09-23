<?php

namespace Tests\Unit;

use App\Jobs\ProcessSubmissionJob;
use App\Services\Submission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProcessSubmissionJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_process_submission_job_exception_handling()
    {
        $serviceMock = \Mockery::mock(Submission::class);
        $serviceMock->shouldReceive('save')
            ->once()
            ->andThrow(new \Exception('Service error'));

        $job = new ProcessSubmissionJob(['name' => 'John Doe', 'email' => 'john.doe@mail.com', 'message' => 'Test message']);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Job failed: Service error');

        $job->handle($serviceMock);
    }

    public function test_process_submission_job_success()
    {
        $service = new Submission();
        $job = new ProcessSubmissionJob(['name' => 'John Doe', 'email' => 'john.doe@mail.com', 'message' => 'Test message']);

        $job->handle($service);

        $this->assertDatabaseHas('submissions', [
            'name' => 'John Doe',
            'email' => 'john.doe@mail.com',
            'message' => 'Test message'
        ]);
    }
}
