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
        $managers = Manager::all();

        return view('admin.shop-create', compact('areas', 'genres', 'images', 'managers'));
    }

    public function show(Request $request) {
        $managerId = $request->only('shopManager');
        $shopManager = !empty($managerId) ? Manager::find($managerId['shopManager']) : null ;

        $managerName = $shopManager ? $shopManager->name : '' ;

        return redirect('/manager/new')->withInput()->with('managerName', $managerName);
    }

    public function managerUpdate($shopId) {
        $shop = Shop::find($shopId);
        $areas = Area::all();
        $genres = Genre::all();
        $images = Image::all();
        $managers = Manager::all();

        return view('admin.shop-update', compact('shop', 'areas', 'genres', 'images', 'managers'));
    }

    public function managerUpload(Request $request) {
        $dir = 'image';
        $fileName = $request->file('image')->getClientOriginalName();

        $request->file('image')->storeAs('public/' . $dir, $fileName);

        $image['image_name'] = $fileName;
        $image['image_url'] = 'storage/' . $dir . '/' . $fileName;
        Image::create($image);

        return redirect('/manager/index')->with('message', 'アップロード完了しました');
    }
}
