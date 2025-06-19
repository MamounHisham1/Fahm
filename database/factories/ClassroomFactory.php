<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::inRandomOrder()->first()->id,
            'name' => strtoupper(fake()->word()),
            'grade_id' => Grade::inRandomOrder()->first()->id,
        ];
    }
}
