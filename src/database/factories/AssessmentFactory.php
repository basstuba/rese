<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AssessmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $evaluations = [
            '★★★★★' => 5,
            '★★★★☆' => 4,
            '★★★☆☆' => 3,
            '★★☆☆☆' => 2,
            '★☆☆☆☆' => 1,
        ];

        $evaluate = $this->faker->randomElement(array_keys($evaluations));

        return [
            'user_id' => $this->faker->numberBetween(2, 11),
            'shop_id' => $this->faker->numberBetween(2, 20),
            'evaluate' => $evaluate,
            'count' => $evaluations[$evaluate],
            'assessment_comment' => $this->faker->realText(50),
            'photo_url' => 'storage/image/hall.jpg',
        ];
    }
}
