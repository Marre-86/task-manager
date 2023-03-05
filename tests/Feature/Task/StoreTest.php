<?php

namespace Tests\Feature\Task;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function testDataCannotBeSentByGuest(): void
    {
        $response = $this
            ->post(route('tasks.store'), ['name' => '']);

        $response->assertStatus(403);
    }

    public function testEmptyRequiredFieldsAreNotAccepted(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('tasks.store'), ['name' => '']);
        $response->assertInvalid(['name']);

        $response = $this
            ->actingAs($user)
            ->post(route('tasks.store'), ['status_id' => '']);
        $response->assertInvalid(['status_id']);
    }

    public function testFormRepopulatesWhenValidationFails(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->followingRedirects()
            ->post(route('tasks.store'), ['name' => 'wastedd', 'status_id' => '']);
        $expected = '<input class="rounded border-gray-300 w-1/3" name="name" type="text" value="wastedd" id="name">';
        $response->assertSee($expected, false);

        $response = $this
            ->actingAs($user)
            ->followingRedirects()
            ->post(route('tasks.store'), ['name' => '', 'description' => 'Anna failed in the morning']);
        $expected = '<textarea class="rounded border-gray-300 w-1/3 h-32" cols="50" rows="10" name="description" id="description">Anna failed in the morning</textarea>'; // phpcs:ignore
        $response->assertSee($expected, false);

        // Для проверки репопуляции статусов нужно чтоб они наличествовали в БД, поэтому используем сидирование.
        $this->seed();
        $response = $this
            ->actingAs($user)
            ->followingRedirects()
            ->post(route('tasks.store'), ['name' => '', 'status_id' => '2']);
        $expected = '<option selected="selected" value="2">лыжный</option>';
        $response->assertSee($expected, false);

        $response = $this
            ->actingAs($user)
            ->followingRedirects()
            ->post(route('tasks.store'), ['name' => '', 'assigned_to_id' => '1']);
        $expected = "<option selected=\"selected\" value=\"{$user->id}\">{$user->name}</option>";
         $response->assertSee($expected, false);
    }

    public function testTaskIsStoredIntoDatabase(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('tasks.store'), ['name' => 'valerra', 'status_id' => '1', 'description' => 'ghe']);

        $this->assertDatabaseHas('tasks', [
            'name' => 'valerra', 'status_id' => '1', 'description' => 'ghe'
        ]);
    }
}
