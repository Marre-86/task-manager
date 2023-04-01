<?php

namespace Tests\Feature\Task;

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function testCannotBeAccessedByGuest(): void
    {
        $task = Task::factory()->create();

        $response = $this
            ->delete(route('tasks.destroy', $task));

        $response->assertStatus(403);
    }

    public function testCannotBeAccessedByNotCreator(): void
    {
        $task = Task::factory()->create();
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete(route('tasks.destroy', $task));

        $response->assertStatus(403);
    }

    public function testTaskIsDeletedFromDatabase(): void
    {
        $user = User::factory()->create();

        $this->seed();

        $task = Task::where('name', 'Сделать растяжку')->firstOrFail();

        $response = $this
            ->actingAs($task->created_by)
            ->delete(route('tasks.destroy', $task));

        $this->assertDatabaseMissing('tasks', ['name' => 'Сделать растяжку']);
    }
}
