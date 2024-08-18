<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class LikeController extends Controller
{
    public function likeCreate(Request $request) {
        $user = Auth::user();
        $favorite = $request->only('shop_id');
        $favorite['user_id'] = $user->id;

        Favorite::create($favorite);

        return redirect('/');
    }

    public function likeDelete(Request $request) {
        $user = Auth::user();
        Favorite::where('shop_id', $request->shop_id)->where('user_id', $user->id)->delete();

        if($request->has('myPage')) {
            return redirect('/link/user');
        }else{
            return redirect('/');
        }
    }
}
