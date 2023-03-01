<?php

namespace Tests\Feature\TaskStatus;

use App\Models\User;
use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    public function testCreationFormCanBeRendered(): void
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('task_statuses.edit', $taskStatus));

        $response->assertOk();
    }

    public function testCreationFormCanNotBeRenderedForGuest(): void
    {
        $taskStatus = TaskStatus::factory()->create();

        $response = $this->get(route('task_statuses.edit', $taskStatus));

        $response->assertStatus(403);
    }
}
