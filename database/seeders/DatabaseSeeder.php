<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->admin()->create();
        \App\Models\User::factory(10)->developer()->create();
        \App\Models\User::factory(10)->staff()->create();

        \App\Models\TaskStatus::factory(1)->step(0)->create([ 'name' => 'Not acknowledged' ]);
        \App\Models\TaskStatus::factory(1)->step(1)->create([ 'name' => 'Approved' ]);
        \App\Models\TaskStatus::factory(1)->step(2)->create([ 'name' => 'In progress' ]);
        \App\Models\TaskStatus::factory(1)->step(2)->create([ 'name' => 'In testing' ]);
        \App\Models\TaskStatus::factory(1)->step(3)->create([ 'name' => 'Complete' ]);

        \App\Models\Task::factory(5)->bug()->create();
        \App\Models\Task::factory(10)->feature()->create();

        \App\Models\Note::factory(50)->create();
    }
}
