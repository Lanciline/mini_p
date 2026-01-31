<?php

namespace Tests\Unit;

use App\Models\Property;
use App\Models\Reservation;
use App\Services\AvailabilityService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class AvailabilityServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_property_is_unavailable_when_reservation_overlaps()
    {
        $property = Property::factory()->create();

        Reservation::factory()->create([
            'property_id' => $property->id,
            'start_date' => now()->addDays(5)->toDateString(),
            'end_date' => now()->addDays(8)->toDateString(),
            'status' => 'confirmed',
        ]);

        $service = new AvailabilityService();

        $this->assertFalse($service->isAvailable($property, now()->addDays(6)->toDateString(), now()->addDays(7)->toDateString()));
    }

    public function test_property_is_available_when_no_overlap()
    {
        $property = Property::factory()->create();

        Reservation::factory()->create([
            'property_id' => $property->id,
            'start_date' => now()->addDays(1)->toDateString(),
            'end_date' => now()->addDays(2)->toDateString(),
            'status' => 'confirmed',
        ]);

        $service = new AvailabilityService();

        $this->assertTrue($service->isAvailable($property, now()->addDays(3)->toDateString(), now()->addDays(4)->toDateString()));
    }
}
