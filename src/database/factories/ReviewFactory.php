<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,10),
            'shop_id' => $this->faker->numberBetween(2,20),
            'evaluate' => $this->faker->randomElement(['★★★★★', '★★★★☆', '★★★☆☆', '★★☆☆☆', '★☆☆☆☆']),
            'review_comment' => $this->faker->realText(50),
            'posted_on' => $this->faker->dateTimeBetween('-4 week', '-1 week'),
        ];
    }
}
