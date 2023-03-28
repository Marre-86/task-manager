<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\TaskStatus;
use App\Models\Task;
use App\Models\User;
use App\Models\Label;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        Label::factory()->create();
        Label::factory()->create([
            'name' => 'Test Label',
            'description' => 'anything is possible',
        ]);

        TaskStatus::factory()->create([
            'name' => Str::random(10),
        ]);
        TaskStatus::factory()->create([
            'name' => 'лыжный',
        ]);
        TaskStatus::factory()->create([
            'name' => 'овощной',
        ]);

        Task::factory()->create([
            'name' => 'путинахуйнуть',
            'description' => 'такчтобнедёргался',
            'status_id' => 1,
            'created_by_id' => $user1->id,
            'assigned_to_id' => $user2->id,
        ]);
        Task::factory()->create([
            'name' => 'Сделать растяжку',
            'description' => '',
            'status_id' => 2,
            'created_by_id' => $user2->id,
            'assigned_to_id' => $user1->id,
        ]);
        Task::factory()->create([
            'name' => 'Полетать',
            'description' => '',
            'status_id' => 1,
            'created_by_id' => $user2->id,
            'assigned_to_id' => $user1->id,
        ]);
    }
}
