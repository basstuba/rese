<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        if(Auth::check()) {
            $user = Auth::user();
            $shops = Shop::with('favorites')->all();

            return view('/', compact('areas', 'genres', 'user', 'shops'));
        }else{
            $shops = Shop::all();

            return view('/', compact('areas', 'genres', 'shops'));
        }
    }
}
