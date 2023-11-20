<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // TODO: Revisit user_id and task_id if time doesn't run over.
        return [
            'user_id' => User::inRandomOrder()->get()->first(),
            'task_id' => Task::inRandomOrder()->get()->first(),
            'body' => fake()->paragraph(),
        ];
    }
}
