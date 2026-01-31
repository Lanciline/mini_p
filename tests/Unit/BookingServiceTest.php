<?php

namespace Tests\Unit;

use App\Models\Property;
use App\Models\Reservation;
use App\Models\User;
use App\Services\BookingService;
use App\Services\AvailabilityService;
use App\Services\PaymentServiceMock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_reservation_and_charge_mock()
    {
        $user = User::factory()->create();
        $property = Property::factory()->create(['price_per_night' => 50]);

        $availability = new AvailabilityService();
        $paymentMock = new PaymentServiceMock();
        $booking = new BookingService($availability, $paymentMock);

        $start = now()->addDays(3)->toDateString();
        $end = now()->addDays(5)->toDateString();

        $reservation = $booking->createReservation($user, $property, $start, $end);

        $this->assertDatabaseHas('reservations', ['id' => $reservation->id, 'status' => 'confirmed', 'payment_status' => 'paid']);
    }

    public function test_cannot_create_reservation_if_unavailable()
    {
        $user = User::factory()->create();
        $property = Property::factory()->create(['price_per_night' => 50]);

        // create an existing reservation
        Reservation::factory()->create([
            'property_id' => $property->id,
            'start_date' => now()->addDays(4)->toDateString(),
            'end_date' => now()->addDays(6)->toDateString(),
            'status' => 'confirmed',
        ]);

        $availability = new AvailabilityService();
        $paymentMock = new PaymentServiceMock();
        $booking = new BookingService($availability, $paymentMock);

        $this->expectException(\Exception::class);

        $booking->createReservation($user, $property, now()->addDays(5)->toDateString(), now()->addDays(7)->toDateString());
    }
}
