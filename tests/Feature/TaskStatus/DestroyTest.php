<?php

namespace Tests\Feature\TaskStatus;

use App\Models\User;
use App\Models\TaskStatus;
use App\Models\Task;
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

    public function testStatusCannotBeDeletedIfUsedByTask(): void
    {
        $user = User::factory()->create();

        $this->seed();

        $taskStatus = TaskStatus::where('name', 'лыжный')->first();

        $response = $this
            ->actingAs($user)
            ->delete(route('task_statuses.destroy', $taskStatus));

        $this->assertDatabaseHas('task_statuses', ['name' => 'лыжный']);
    }

    public function testStatusIsDeletedFromDatabase(): void
    {
        $user = User::factory()->create();

        $this->seed();

        $taskStatus = TaskStatus::where('name', 'овощной')->first();

        $response = $this
            ->actingAs($user)
            ->delete(route('task_statuses.destroy', $taskStatus));

        $this->assertDatabaseMissing('task_statuses', ['name' => 'овощной']);
    }
}
