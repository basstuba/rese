<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
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
