<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        $start = Carbon::now()->addDays(rand(1,30));
        $end = (clone $start)->addDays(rand(1,7));

        return [
            'user_id' => User::factory(),
            'property_id' => Property::factory(),
            'start_date' => $start->toDateString(),
            'end_date' => $end->toDateString(),
            'status' => 'confirmed',
            'payment_status' => 'paid',
            'total_amount' => 100,
        ];
    }
}
