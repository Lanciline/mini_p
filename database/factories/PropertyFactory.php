<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'price_per_night' => $this->faker->numberBetween(30,300),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
            'meta' => null,
        ];
    }
}
