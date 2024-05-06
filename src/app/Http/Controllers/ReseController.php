<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReseRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Time;
use App\Models\Number;
use App\Models\Shop;
use App\Models\User;

class ReseController extends Controller
{
    public function indicate(Request $request) {
        $sendId = $request->only('sendId');
        
        return redirect()->route('detail', [ 'shop' => $sendId['sendId'] ])->withInput();
    }
}
