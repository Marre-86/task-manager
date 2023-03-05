<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\TaskStatus;
use App\Models\Task;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        DB::table('task_statuses')->insert([
            'name' => Str::random(10),
            'created_at' => time(),
        ]);
        DB::table('task_statuses')->insert([
            'name' => 'лыжный',
            'created_at' => time(),
        ]);

        DB::table('tasks')->insert([
            'name' => 'путинахуйнуть',
            'description' => 'такчтобнедёргался',
            'status_id' => 1,
            'created_by_id' => $user1->id,
            'assigned_to_id' => $user2->id,
            'created_at' => time(),
        ]);
        DB::table('tasks')->insert([
            'name' => 'Сделать растяжку',
            'description' => '',
            'status_id' => 2,
            'created_by_id' => $user2->id,
            'assigned_to_id' => $user1->id,
            'created_at' => time(),
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
