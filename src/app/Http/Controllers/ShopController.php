<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\Time;
use App\Models\Number;
use App\Models\Area;
use App\Models\Genre;
use Carbon\Carbon;

class ShopController extends Controller
{
    public function index() {
        $areas = Area::all();
        $genres = Genre::all();

        $user = Auth::user();
        $shops = session()->has('shops') ? session('shops') : (Auth::check() ? Shop::withUserFavorites($user)->get() : Shop::all());

        return view('index', compact('areas', 'genres', 'shops'));
    }

    public function search(Request $request) {
        $user = Auth::user();
        $query = Auth::check() ? Shop::withUserFavorites($user) : Shop::query();

        $shops = $query->AreaSearch($request->area)
                    ->GenreSearch($request->genre)
                    ->KeywordSearch($request->keyword)
                    ->get();

        return redirect('/')->withInput()->with('shops', $shops);
    }

    public function detail($shopId) {
        $shop = Shop::find($shopId);
        $reviews = Review::orderBy('posted_on', 'desc')->where('shop_id', $shopId)->get();

        $times = Time::all();
        $numbers = Number::all();
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        return view('shop', compact('shop', 'reviews', 'times', 'numbers', 'tomorrow'));
    }

    public function linkUser() {
        $user = Auth::user();
        $reservations = Reservation::with('shop')->orderBy('date', 'asc')->orderBy('time', 'asc')->where('user_id', $user['id'])->get();
        $favorites = Favorite::with('shop')->orderBy('shop_id', 'asc')->where('user_id', $user['id'])->get();

        return view('my-page', compact('user', 'reservations', 'favorites'));
    }

    public function edit($reservationId) {
        $reservation = Reservation::with('shop')->find($reservationId);

        $times = Time::all();
        $numbers = Number::all();
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        return view('edit', compact('reservation', 'times', 'numbers', 'tomorrow'));
    }
}
