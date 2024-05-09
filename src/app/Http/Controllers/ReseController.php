<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReseRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class ReseController extends Controller
{
    public function indicate(Request $request) {
        $sendId = $request->only('sendId');

        return redirect()->route('detail', [ 'shop' => $sendId['sendId'] ])->withInput();
    }

    public function create(ReseRequest $request) {
        $reserved = $request->only('shop_id', 'date', 'time', 'number');
        $user = Auth::user();
        $shopId = $request->only('shop_id');

        $reserved['user_id'] = $user['id'];
        Reservation::create($reserved);

        return view('done', compact('shopId'));
    }

    public function delete(Request $request) {
        Reservation::find($request->id)->delete();

        return redirect('/link/user');
    }

    public function indicateEdit(Request $request) {
        $sendId = $request->only('sendId');

        return redirect()->route('edit', [ 'reservation' => $sendId['sendId'] ])->withInput();
    }

    public function reservationEdit(ReseRequest $request) {
        $edit = $request->only('date', 'time', 'number');
        Reservation::find($request->id)->update($edit);

        return view('edited');
    }
}
