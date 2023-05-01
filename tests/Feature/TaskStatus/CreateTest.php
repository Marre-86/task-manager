<?php

namespace Tests\Feature\TaskStatus;

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
            ->get(route('task_statuses.create'));

        $response->assertOk();
        $response->assertSee(__('status.create_status'));
    }

    public function testCreationFormCanNotBeRenderedForGuest(): void
    {

        $response = $this->get(route('task_statuses.create'));

        $response->assertStatus(403);
    }
}
