<?php

namespace Tests\Feature\Label;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function testDataCannotBeSentByGuest(): void
    {
        $response = $this
            ->post(route('labels.store'), ['name' => '']);

        $response->assertStatus(403);
    }

    public function testEmptyLabelIsNotAccepted(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('labels.store'), ['name' => '']);

        $response->assertInvalid(['name']);
    }

    public function testLabelIsStoredIntoDatabase(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('labels.store'), ['name' => 'blinken', 'description' => 'one-two three']);

        $this->assertDatabaseHas('labels', [
            'name' => 'blinken', 'description' => 'one-two three'
        ]);
    }
}
