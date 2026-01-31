<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with('images')->withAvg(['reviews' => function ($query) {
            $query->where('approved', true);
        }], 'rating');

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        if ($request->filled('min_price')) {
            $query->where('price_per_night', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price_per_night', '<=', $request->max_price);
        }

        $properties = $query->paginate(12)->withQueryString();

        return Inertia::render('Properties/Index', compact('properties'));
    }

    public function show(Property $property)
    {
        $property->load(['images', 'reviews' => function ($q) {
            $q->where('approved', true)->with('user');
        }])->loadAvg(['reviews' => function ($q) {
            $q->where('approved', true);
        }], 'rating');
        return Inertia::render('Properties/Show', compact('property'));
    }

    public function store(StorePropertyRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $property = Property::create($data);

        return redirect()->route('properties.show', $property)->with('status','Property created');
    }

    public function update(StorePropertyRequest $request, Property $property)
    {
        $this->authorize('update', $property);
        $property->update($request->validated());
        return back()->with('status','Updated');
    }

    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);
        $property->delete();
        return redirect()->route('properties.index')->with('status','Deleted');
    }
}
