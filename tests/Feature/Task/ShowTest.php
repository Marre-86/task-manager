<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function testViewIsRendered(): void
    {
        $this->seed();

        $task = Task::firstOrFail();
        $response = $this
            ->get(route('tasks.show', $task));

        $response->assertOk();
        $response->assertSee($task->name);
        $response->assertSee($task->description ?? '');
        $response->assertSee($task->status->name);
    }
}
