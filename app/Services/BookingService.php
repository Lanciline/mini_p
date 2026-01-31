<?php

namespace App\Services;

use App\Models\Property;
use App\Models\Reservation;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingService
{
    protected AvailabilityService $availability;
    protected PaymentServiceMock $payment;

    public function __construct(AvailabilityService $availability, PaymentServiceMock $payment)
    {
        $this->availability = $availability;
        $this->payment = $payment;
    }

    /**
     * Attempt to create a reservation
     */
    public function createReservation(User $user, Property $property, string $startDate, string $endDate): Reservation
    {
        if (! $this->availability->isAvailable($property, $startDate, $endDate)) {
            throw new \Exception('Property not available for the selected dates');
        }

        return DB::transaction(function () use ($user, $property, $startDate, $endDate) {
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();

            $nights = $end->diffInDays($start) ?: 1;
            $total = $property->price_per_night * $nights;

            $reservation = Reservation::create([
                'user_id' => $user->id,
                'property_id' => $property->id,
                'start_date' => $start->toDateString(),
                'end_date' => $end->toDateString(),
                'status' => 'pending',
                'payment_status' => 'pending',
                'total_amount' => $total,
            ]);

            // create mock payment record
            $paymentModel = Payment::create([
                'reservation_id' => $reservation->id,
                'gateway' => 'mock',
                'status' => 'pending',
                'amount' => $total,
            ]);

            // attempt to charge via mock gateway
            $result = $this->payment->charge($paymentModel);

            if (($result['status'] ?? null) === 'paid') {
                $paymentModel->refresh();
                $reservation->update(['status' => 'confirmed', 'payment_status' => 'paid']);
            }

            return $reservation->fresh();
        });
    }
}
