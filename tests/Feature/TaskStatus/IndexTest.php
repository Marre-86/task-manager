<?php

namespace Tests\Feature\TaskStatus;

use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testDatabaseStatusesAreRendered(): void
    {
        // Run the DatabaseSeeder...
        $this->seed();

//        $this->assertDatabaseHas('task_statuses', [
//            'name' => 'лыжный'
//        ]);
//        $this->assertDatabaseCount('task_statuses', 2);

        $taskStatuses = TaskStatus::paginate(15);

        $response = $this
            ->get(route('task_statuses.index'))
            ->assertSee('лыжный');
    }
}
