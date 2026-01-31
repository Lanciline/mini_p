<?php

namespace App\Services;

use App\Models\Property;
use App\Models\Reservation;
use Carbon\Carbon;

class AvailabilityService
{
    /**
     * Check availability for a property between two dates (inclusive)
     * Returns true if available, false if any overlapping reservation exists.
     */
    public function isAvailable(Property $property, string $startDate, string $endDate): bool
    {
        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();

        $conflict = $property->reservations()
            ->where(function ($q) use ($start, $end) {
                $q->whereBetween('start_date', [$start, $end])
                  ->orWhereBetween('end_date', [$start, $end])
                  ->orWhereRaw('? BETWEEN start_date AND end_date', [$start->toDateString()])
                  ->orWhereRaw('? BETWEEN start_date AND end_date', [$end->toDateString()]);
            })
            ->whereIn('status', ['pending','confirmed'])
            ->exists();

        return !$conflict;
    }
}
