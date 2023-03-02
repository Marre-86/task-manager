<?php

namespace Tests\Feature\TaskStatus;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function testDataCannotBeSentByGuest(): void
    {
        $response = $this
            ->post(route('task_statuses.store'), ['name' => '']);

        $response->assertStatus(403);
    }

    public function testEmptyStatusIsNotAccepted(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('task_statuses.store'), ['name' => '']);

        $response->assertInvalid(['name']);
    }

    public function testStatusIsStoredIntoDatabase(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('task_statuses.store'), ['name' => 'blinken']);

        $this->assertDatabaseHas('task_statuses', [
            'name' => 'blinken'
        ]);
    }
}
