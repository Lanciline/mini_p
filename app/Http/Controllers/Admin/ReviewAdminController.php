<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReviewAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('moderate', Review::class);
        $reviews = Review::where('approved', false)->with('property','user')->latest()->get();
        return Inertia::render('Admin/Reviews/Index', compact('reviews'));
    }

    public function approve(Review $review)
    {
        $this->authorize('moderate', $review);
        $review->update(['approved' => true]);
        return redirect()->back()->with('status','Approved');
    }

    public function reject(Review $review)
    {
        $this->authorize('moderate', $review);
        $review->delete();
        return redirect()->back()->with('status','Rejected');
    }
}
