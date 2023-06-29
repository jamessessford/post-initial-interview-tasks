<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Category;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $dev = User::inRandomOrder()->where( 'type', 'App\Models\Developer' )->first();
        $user = User::inRandomOrder()->first();
        $category = Category::inRandomOrder()->first();

        return [
            'name' => fake()->unique()->sentence(6),
            'description' => fake()->unique()->sentence(15),
            'due_date' => Carbon::now()->subMinutes(rand(1, 55)),
            'hours_required' => rand(1,60), // password
            'developer_id' => $dev->id,
            'user_id' => $user->id,
            'category_id' => $category->id,
        ];

    }



}
