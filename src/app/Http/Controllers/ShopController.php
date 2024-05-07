<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Time;
use App\Models\Number;
use App\Models\Area;
use App\Models\Genre;
use Carbon\Carbon;

class ShopController extends Controller
{
    public function index(Request $request) {
        $areas = Area::all();
        $genres = Genre::all();

        $shops = session()->has('shops') ? session('shops') : Shop::all();
        $user = Auth::check() ? Auth::user() : [ 'id' => 0 ] ;
        $favorites = Favorite::where('user_id', $user['id'])->get();

        return view('index', compact('areas', 'genres', 'shops', 'user', 'favorites'));
    }

    public function search(Request $request) {
        $shops = Shop::AreaSearch($request->area)->GenreSearch($request->genre)->KeywordSearch($request->keyword)->get();

        return redirect('/')->withInput()->with('shops', $shops);
    }

    public function detail($shopId) {
        $shop = Shop::find($shopId);

        $times = Time::all();
        $numbers = Number::all();
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        return view('shop', compact('shop', 'times', 'numbers', 'tomorrow'));
    }

    public function linkRegister() {
        return view('auth.register');
    }

    public function linkLogin() {
        return view('auth.login');
    }

    public function thanks() {
        return view('thanks');
    }

    public function linkUser() {
        $user = Auth::user();
        $reservations = Reservation::with('shop')->orderBy('date', 'asc')->orderBy('time', 'asc')->where('user_id', $user['id'])->get();
        $favorites = Favorite::with('shop')->orderBy('shop_id', 'asc')->where('user_id', $user['id'])->get();

        return view('my-page', compact('user', 'reservations', 'favorites'));
    }
}
