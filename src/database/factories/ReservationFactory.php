<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(2,11),
            'shop_id' => $this->faker->numberBetween(1,20),
            'date' => $this->faker->dateTimeBetween('+1 week', '+3 week'),
            'time' => $this->faker->randomElement(['13:00', '15:00', '17:00']),
            'number' => $this->faker->randomElement(['2人', '6人', '8人']),
        ];
    }
}
