<?php

namespace Tests\Feature\Label;

use App\Models\User;
use App\Models\Label;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function testDataCannotBeSentByGuest(): void
    {
        $label = Label::factory()->create();

        $response = $this
            ->delete(route('labels.destroy', $label));

        $response->assertStatus(403);
    }
/*
    public function testLabelCannotBeDeletedIfUsedByTask(): void
    {
        $user = User::factory()->create();

        $this->seed();

        $taskStatus = TaskStatus::where('name', 'лыжный')->first();

        $response = $this
            ->actingAs($user)
            ->delete(route('task_statuses.destroy', $taskStatus));

        $this->assertDatabaseHas('task_statuses', ['name' => 'лыжный']);
    }
*/
    public function testLabelIsDeletedFromDatabase(): void
    {
        $user = User::factory()->create();

        $this->seed();

        $label = Label::where('name', 'Test Label')->first();

        $response = $this
            ->actingAs($user)
            ->delete(route('labels.destroy', $label));

        $this->assertDatabaseMissing('labels', ['name' => 'Test Label']);
    }
}
