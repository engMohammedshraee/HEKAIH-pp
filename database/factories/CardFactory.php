<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'user_id' => fake()->randomElement([1,2]),
            'titel' => fake()->sentence(15),
            'desc' => fake()->sentence(20),
            'category' => fake()->randomElement([
                'تعليمي',
                'مغامرات',
                'حيوانات',
                'خيال علمي'
            ]),
            'level' => fake()->randomElement([
                1,
                2,
                3,
                4
            ]),
            'approved' => fake()->randomElement([true,false]),
        ];
    }
}
