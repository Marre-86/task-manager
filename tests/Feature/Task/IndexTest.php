<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testDatabaseTasksAreRendered(): void
    {
        $this->seed();

        $task = Task::first();
        $response = $this
            ->get(route('tasks.index'));

            $response->assertSee($task->name);
            $response->assertSee($task->status->name);
            $response->assertSee($task->created_by->name);
    }
}
