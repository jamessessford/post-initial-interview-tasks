<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Support\Str;

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


        User::create([
            'name' => 'Nathan',
            'email' => 'nzagrovic@gmail.com',
            'type' => 'App\Models\Admin',
            'email_verified_at' => now(),
            'password' => bcrypt('testingpw'),
            'remember_token' => Str::random(10),
        ]);

        User::factory(10)->admin()->create();
        User::factory(10)->developer()->create();
        User::factory(10)->staff()->create();

        Category::create([
            'name' => 'Bug'
        ]);

        Category::create([
            'name' => 'Feature'
        ]);

        Task::factory(10)->create();



    }
}
