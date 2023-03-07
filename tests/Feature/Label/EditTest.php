<?php

namespace Tests\Feature\Label;

use App\Models\User;
use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdateFormCanBeRendered(): void
    {
        $user = User::factory()->create();
        $label = Label::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('labels.edit', $label));

        $response->assertOk();
    }

    public function testUpdateFormCanNotBeRenderedForGuest(): void
    {
        $label = Label::factory()->create();

        $response = $this->get(route('labels.edit', $label));

        $response->assertStatus(403);
    }
}
