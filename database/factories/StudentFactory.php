<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'firstname' => $this->faker->name(),
            'lastname' => $this->faker->words(2, true),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->freeEmail(),
            'birthday' => $this->faker->date(),
            'signed_up_the' => $this->faker->date()
        ];
    }
}
