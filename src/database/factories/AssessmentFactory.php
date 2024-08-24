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
        return [
            'user_id' => $this->faker->numberBetween(2, 11),
            'shop_id' => $this->faker->numberBetween(2, 20),
            'count' => $this->faker->numberBetween(1, 5),
            'assessment_comment' => $this->faker->realText(50),
            'photo_url' => 'storage/image/hall.jpg',
        ];
    }
}
