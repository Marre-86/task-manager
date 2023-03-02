<?php

namespace Tests\Feature\TaskStatus;

use App\Models\User;
use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testDataCannotBeSentByGuest(): void
    {
        $taskStatus = TaskStatus::factory()->create();

        $response = $this
            ->patch(route('task_statuses.update', $taskStatus), ['name' => '']);

        $response->assertStatus(403);
    }

    public function testEmptyStatusIsNotAccepted(): void
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch(route('task_statuses.update', $taskStatus), ['name' => '']);

        $response->assertInvalid(['name']);
    }

    public function testStatusIsUpdatedIntoDatabase(): void
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch(route('task_statuses.update', $taskStatus), ['name' => 'vespuchi']);

        $this->assertDatabaseHas('task_statuses', ['name' => 'vespuchi']);
    }
}
