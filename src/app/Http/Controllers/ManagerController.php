<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ManagerRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\Manager;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Image;

class ManagerController extends Controller
{
    public function managerIndex() {
        $user = Auth::user();

        return view('admin.manager', compact('user'));
    }

    public function managerReservation($shopId) {
        $reservations = Reservation::with('user')->orderBy('date', 'asc')->orderBy('time', 'asc')->where('shop_id', $shopId)->get();

        return view('admin.reservation', compact('reservations'));
    }

    public function managerNew() {
        $areas = Area::all();
        $genres = Genre::all();
        $images = Image::all();

        return view('admin.shop-create', compact('areas', 'genres', 'images'));
    }

    public function managerUpdate($shopId) {
        $shop = Shop::find($shopId);
        $areas = Area::all();
        $genres = Genre::all();
        $images = Image::all();

        return view('admin.shop-update', compact('shop', 'areas', 'genres', 'images'));
    }
}
