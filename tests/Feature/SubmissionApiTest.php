<?php

namespace Tests\Feature;

use App\Jobs\ProcessSubmissionJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class SubmissionApiTest extends TestCase
{
    use RefreshDatabase;

    protected const API_URL = '/v1/submissions';

    public function test_successful_submission_with_valid_data(): void
    {
        Queue::fake();

        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@mail.com',
            'message' => 'This is a test message.'
        ];

        $response = $this->postJson(static::API_URL, $data);

        $response->assertStatus(202);

        $response->assertJson([
            'message' => 'Submission received and is being processed.'
        ]);

        Queue::assertPushed(ProcessSubmissionJob::class, function ($job) use ($data) {
            return $job->data['email'] === 'john.doe@mail.com';
        });
    }

    /**
     * Test API submission with missing required fields (validation error).
     *
     * @return void
     */
    public function test_submission_with_missing_required_fields()
    {

        $data = [
            'email' => 'john.doe@mail.com'
        ];

        $response = $this->postJson(static::API_URL, $data);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['name', 'message']);
    }

    /**
     * Test API submission with invalid email format.
     *
     * @return void
     */
    public function test_submission_with_invalid_email_format()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'message' => 'This is a test message.'
        ];

        $response = $this->postJson(static::API_URL, $data);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['email']);
    }
}
