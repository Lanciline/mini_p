<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(StoreReviewRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $data['approved'] = false; // moderation required

        $review = Review::create($data);

        return response()->json(['review' => $review], 201);
    }
}


namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(StoreReviewRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        $review = Review::create($data);

        return back()->with('status','Merci pour votre avis — en attente de modération');
    }
}
