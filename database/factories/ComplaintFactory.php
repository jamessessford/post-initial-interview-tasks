<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Complaint;

class ComplaintFactory extends Factory
{
    protected $model = Complaint::class;

    public function definition()
    {
        return [
            'date' => $this->faker->date,
            'summary' => $this->faker->sentence,
            'full_text' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['not_acknowledged', 'pending_investigation', 'under_investigation', 'resolved_justified', 'resolved_unjustified']),
            'complaint_type' => $this->faker->randomElement(['complaint', 'dissatisfaction']),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}

