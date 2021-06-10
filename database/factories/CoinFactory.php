<?php

namespace Database\Factories;

use App\Models\Coin;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoinFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "marketCap" => $this->faker->numberBetween(0,500),
            "votes" => $this->faker->numberBetween(0,1000),
            "icon" => "https://via.placeholder.com/150",
            "promoted" => rand(0,1) ? true : false,
        ];
    }
}
