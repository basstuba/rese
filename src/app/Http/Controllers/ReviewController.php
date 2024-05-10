<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Review;
use App\Models\Evaluation;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function review($shopId) {
        $shop = Shop::find($shopId);
        $evaluations = Evaluation::all();

        return view('review', compact('shop', 'evaluations'));
    }

    public function reviewCreate(ReviewRequest $request) {
        $review = $request->only('shop_id', 'evaluate', 'review_comment');
        $user = Auth::user();
        $review['user_id'] = $user['id'];
        $review['posted_on'] = Carbon::today()->format('Y-m-d');
        $shopId = $request->only('shop_id');

        Review::create($review);

        return view('review-done', compact('shopId'));
    }
}
