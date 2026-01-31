<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Property;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'property_id' => Property::factory(),
            'reservation_id' => null,
            'rating' => $this->faker->numberBetween(1,5),
            'comment' => $this->faker->sentence(),
            'approved' => false,
        ];
    }
}
