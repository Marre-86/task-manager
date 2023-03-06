<?php

namespace Tests\Feature\Task;

use App\Models\User;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testCannotBeAccessedByGuest(): void
    {
        $task = Task::factory()->create();

        $response = $this
            ->patch(route('tasks.update', $task), ['name' => '']);

        $response->assertStatus(403);
    }

    public function testFormRepopulatesWhenValidationFails(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create();

        $response = $this
            ->actingAs($user)
            ->followingRedirects()
            ->patch(route('tasks.update', $task), ['name' => '', 'description' => 'some_text']);
        $expected = 'id="description">some_text</textarea>';
        $response->assertSee($expected, false);

        $response = $this
            ->actingAs($user)
            ->followingRedirects()
            ->patch(route('tasks.update', $task), ['name' => 'Allegro', 'status_id' => '']);
        $expected = '<input class="rounded border-gray-300 w-1/3" name="name" type="text" value="Allegro" id="name">';
        $response->assertSee($expected, false);
    }

    public function testEmptyRequiredFieldsAreNotAccepted(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch(route('tasks.update', $task), ['name' => '' ]);
        $response->assertInvalid(['name']);

        $response = $this
            ->actingAs($user)
            ->patch(route('tasks.update', $task), ['name' => 'Baldwin']);
        $response->assertInvalid(['status_id']);
    }

    public function testTaskIsUpdatedIntoDatabase(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create();
        $taskStatus = TaskStatus::factory()->create();

        $paramsForUpdate = ['name' => 'domin55go', 'status_id' => $taskStatus->id,
                            'description' => 'zhopa', 'assigned_to_id' => $user->id ];

        $response = $this
            ->actingAs($user)
            ->patch(route('tasks.update', $task), $paramsForUpdate);

        $this->assertDatabaseHas('tasks', $paramsForUpdate);
    }
}
