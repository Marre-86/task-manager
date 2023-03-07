<?php

namespace Tests\Feature\Label;

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
            ->get(route('labels.create'));

        $response->assertOk();
        $response->assertSee("Создать метку");
    }

    public function testCreationFormCanNotBeRenderedForGuest(): void
    {

        $response = $this->get(route('labels.create'));

        $response->assertStatus(403);
    }
}
