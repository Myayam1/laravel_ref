<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Grade;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $grade = Grade::inRandomOrder()->first();

        return [
            'nama' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'grade_id' => $grade->id,
            'email' => $this->faker->unique()->safeEmail(),
            'alamat' => $this->faker->city(),
        ];
    }
}
