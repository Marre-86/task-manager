<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\TaskStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskStatus>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $creator = User::factory()->create();
        $executor = User::factory()->create();
        $status = TaskStatus::factory()->create();

        return [
            'name' => fake()->word(),
            'description' => fake()->text(),
            'status_id' => $status->id,
            'created_by_id' => $creator->id,
            'assigned_to_id' => $executor->id,
        ];
    }
}
