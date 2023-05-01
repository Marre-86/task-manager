<?php

namespace Tests\Feature\Task;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function testCreationFormCanBeRendered(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('tasks.create'));

        $response->assertOk();
        $response->assertSee(__('task.create_task'));
    }

    public function testCreationFormCanNotBeRenderedForGuest(): void
    {

        $response = $this->get(route('tasks.create'));

        $response->assertStatus(403);
    }
}
