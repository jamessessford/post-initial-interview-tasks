<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Complaint;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $adminUsers = User::factory(10)->admin()->create();
        Complaint::factory(10)
            ->create(['user_id' => $adminUsers->random()->id]);

        $developerUsers = User::factory(10)->developer()->create();
        Complaint::factory(10)
            ->create(['user_id' => $developerUsers->random()->id]);
            
        $staffUsers = User::factory(10)->staff()->create();
        Complaint::factory(10)
            ->create(['user_id' => $staffUsers->random()->id]);
    }
}