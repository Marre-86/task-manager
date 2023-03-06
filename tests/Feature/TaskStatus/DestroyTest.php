<?php

namespace Tests\Feature\TaskStatus;

use App\Models\User;
use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function testDataCannotBeSentByGuest(): void
    {
        $taskStatus = TaskStatus::factory()->create();

        $response = $this
            ->delete(route('task_statuses.destroy', $taskStatus));

        $response->assertStatus(403);
    }

    public function testStatusIsUpdatedIntoDatabase(): void
    {
        $user = User::factory()->create();

        // Run the DatabaseSeeder...
        $this->seed();

        $taskStatus = TaskStatus::where('name', 'лыжный')->first();

        $response = $this
            ->actingAs($user)
            ->delete(route('task_statuses.destroy', $taskStatus));

        $this->assertDatabaseMissing('task_statuses', ['name' => 'лыжный']);
    }
}
