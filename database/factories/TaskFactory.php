<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(rand(3, 8)),
            'description' => $this->faker->paragraph,
            'due_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['pending', 'complete']),
            'user_id' => 1,
        ];
    }
}
