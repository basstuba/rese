<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Time;
use App\Models\Number;
use App\Models\Area;
use App\Models\Genre;

class ShopController extends Controller
{
    /*コーディング用メソッド。コーディング終了後に消去*/
    public function test() {
        return view('');
    }

    public function index() {
        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::all();

        if(Auth::check()) {
            $user = Auth::user();
        }else{
            $user['id'] = '0';
        }
        $favorites = Favorite::where('user_id', $user['id'])->get();

        return view('index', compact('areas', 'genres', 'shops', 'user', 'favorites'));
    }

    public function detail($shopId) {
        $shop = Shop::find($shopId);
        $times = Time::all();
        $numbers = Number::all();

        return view('shop', compact('shop', 'times', 'numbers'));
    }
}
