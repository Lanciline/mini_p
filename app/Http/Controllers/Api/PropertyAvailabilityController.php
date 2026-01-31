<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyAvailabilityController extends Controller
{
    /**
     * Return reserved date ranges for a property
     */
    public function show(Property $property)
    {
        $ranges = $property->reservations()
            ->whereIn('status', ['pending','confirmed'])
            ->get(['start_date','end_date'])
            ->map(function ($r) {
                return [
                    'start' => $r->start_date->toDateString(),
                    'end' => $r->end_date->toDateString(),
                ];
            });

        return response()->json(['blocked' => $ranges]);
    }
}
