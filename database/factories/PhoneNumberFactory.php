<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PhoneNumber>
 */
class PhoneNumberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'call_phone' => $this->faker->phoneNumber(),
            'social_phone' => $this->faker->e164PhoneNumber(),
            'user_id'=>$this->faker->randomElement([1,2,3])
        ];
    }
}
