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
            'shop_id' => $this->faker->numberBetween(1,20),
            'evaluate' => $this->faker->numberBetween(1,5),
            'review_comment' => $this->faker->text(50),
            'posted_on' => $this->faker->dateTimeBetween('-1 week', '-4 week'),
        ];
    }
}
