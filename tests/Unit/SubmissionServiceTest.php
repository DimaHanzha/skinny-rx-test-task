<?php

namespace Tests\Unit;

use App\Events\SubmissionSaved;
use App\Services\Submission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class SubmissionServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_save_submission_success()
    {
        Event::fake();

        $service = new Submission();

        $service->save(['name' => 'John Doe', 'email' => 'john.doe@mail.com', 'message' => 'Test message']);

        $this->assertDatabaseHas('submissions', [
            'name' => 'John Doe',
            'email' => 'john.doe@mail.com',
            'message' => 'Test message',
        ]);

        Event::assertDispatched(SubmissionSaved::class);
    }
}
