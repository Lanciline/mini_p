<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Property;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReservationController extends Controller
{
    protected BookingService $booking;

    public function __construct(BookingService $booking)
    {
        $this->booking = $booking;
        $this->middleware('auth');
    }

    public function store(StoreReservationRequest $request)
    {
        $user = $request->user();
        $property = Property::findOrFail($request->property_id);
        try {
            $reservation = $this->booking->createReservation($user, $property, $request->start_date, $request->end_date);
            return response()->json(['reservation' => $reservation], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function index(Request $request)
    {
        $reservations = $request->user()->reservations()->with('property.images')->latest()->get();
        return Inertia::render('Reservations/Index', compact('reservations'));
    }

    public function show($id)
    {
        $reservation = auth()->user()->reservations()->with('property.images')->findOrFail($id);
        return Inertia::render('Reservations/Show', compact('reservation'));
    }
}
