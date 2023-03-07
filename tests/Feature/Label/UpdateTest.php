<?php

namespace Tests\Feature\Label;

use App\Models\User;
use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testDataCannotBeSentByGuest(): void
    {
        $label = Label::factory()->create();

        $response = $this
            ->patch(route('labels.update', $label), ['name' => '']);

        $response->assertStatus(403);
    }

    public function testEmptyLabelIsNotAccepted(): void
    {
        $user = User::factory()->create();
        $label = Label::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch(route('labels.update', $label), ['name' => '']);

        $response->assertInvalid(['name']);
    }

    public function testLabelIsUpdatedIntoDatabase(): void
    {
        $user = User::factory()->create();
        $label = Label::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch(route('labels.update', $label), ['name' => 'vespuchi', 'description' => 'three two-zero']);

        $this->assertDatabaseHas('labels', ['name' => 'vespuchi', 'description' => 'three two-zero']);
    }
}
