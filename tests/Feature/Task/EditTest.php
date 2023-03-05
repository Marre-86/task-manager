<?php

namespace Tests\Feature\Task;

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdateFormCanBeRendered(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get(route('tasks.edit', $task));

        $response->assertOk();
        $expectedName = "value=\"{$task->name}\"";
        $expectedDescription = $task->description;
        $expectedStatus = "<option selected=\"selected\" value=\"{$task->status->id}\">{$task->status->name}</option>";
        $expectedExecutor = "<option selected=\"selected\" value=\"{$task->assigned_to->id}\">{$task->assigned_to->name}</option>";   // phpcs:ignore
        $response->assertSee($expectedName, false);
        $response->assertSee($expectedDescription, false);
        $response->assertSee($expectedStatus, false);
        $response->assertSee($expectedExecutor, false);
    }

    public function testUpdateFormCanNotBeRenderedForGuest(): void
    {
        $task = Task::factory()->create();

        $response = $this->get(route('tasks.edit', $task));

        $response->assertStatus(403);
    }
}
