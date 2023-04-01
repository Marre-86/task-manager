<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testTasksAreRendered(): void
    {
        $this->seed();

        $task = Task::firstOrFail();
        $response = $this
            ->get(route('tasks.index'));

        $response->assertSee($task->name);
        $response->assertSee($task->status->name);
        $response->assertSee($task->created_by->name);
    }

    public function testFilteringIsWorking1(): void
    {
        $this->seed();

        $task = Task::where('status_id', 1)->firstOrFail();
        $taskNotSee = Task::where('status_id', 2)->firstOrFail();
        $response = $this
            ->get(route('tasks.index') . "?filter%5Bstatus_id%5D={$task->status->id}&filter%5Bcreated_by_id%5D=&filter%5Bassigned_to_id%5D=");  // phpcs:ignore
        $response->assertSee($task->name);
        $response->assertSee($task->status->name);
        $response->assertSee($task->created_by->name);
        $response->assertDontSee($taskNotSee->name);
    }

    public function testFilteringIsWorking2(): void
    {
        $this->seed();
        $user = User::factory()->create();
        $task1 = Task::where('name', 'путинахуйнуть')->firstOrFail();
        $task2 = Task::where('name', 'Сделать растяжку')->firstOrFail();
        $task3 = Task::where('name', 'Полетать')->firstOrFail();

        $response = $this
            ->get(route('tasks.index') . "?filter%5Bstatus_id%5D={$task1->status->id}&filter%5Bcreated_by_id%5D={$user->id}&filter%5Bassigned_to_id%5D={$user->id}");  // phpcs:ignore
        $response->assertDontSee($task1->name);
        $response->assertDontSee($task2->name);
        $response->assertDontSee($task3->name);
    }
}
