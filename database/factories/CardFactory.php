<?php

namespace Database\Factories;

use Carbon\Carbon;
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

            'user_id' => fake()->randomElement([1,2,3]),
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
            'created_at' => $this->generateAprilDate(),
        ];
    }
        protected function generateAprilDate()
    {
        return Carbon::create(
            now()->year, // السنة الحالية
            6, // الشهر (أبريل)
            rand(1, 30), // يوم عشوائي
            rand(0, 23), // ساعة
            rand(0, 59), // دقيقة
            rand(0, 59)  // ثانية
        );
    }
}
