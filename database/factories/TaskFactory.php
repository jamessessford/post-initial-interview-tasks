<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Developer;
use App\Models\User;
use App\Models\Bug;
use App\Models\Feature;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        // TODO: Revisit user_id and developer_id if time doesn't run over.
        return [
            'user_id' => User::where('type', Admin::class)->inRandomOrder()->get()->first(),
            'details' => fake()->paragraph(),
            'hours_required' => fake()->numberBetween(1, 24 * 5),
            'developer_id' => User::where('type', Developer::class)->inRandomOrder()->get()->first(),
        ];
    }

    /**
     * Set the Task type to bug
     */
    public function bug()
    {
        return $this->state(fn(array $attributes) => [
            'type' => Bug::class,
        ]);
    }

    /**
     * Set the Task type to feature
     */
    public function feature()
    {
        return $this->state(fn(array $attributes) => [
            'type' => Feature::class,
        ]);
    }
}
