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

        if($request->has('create')) {
            return redirect()->route('assessment', ['shop' => $request->shop_id]);
        }elseif($request->has('update')) {
            return redirect()->route('assessmentEdit', ['shop' => $request->shop_id]);
        }else{
            return redirect('/');
        }
    }

    public function likeDelete(Request $request) {
        $user = Auth::user();
        Favorite::where('shop_id', $request->shop_id)->where('user_id', $user->id)->delete();

        if($request->has('myPage')) {
            return redirect('/link/user');
        }elseif($request->has('createPage')) {
            return redirect()->route('assessment', ['shop' => $request->shop_id]);
        }elseif($request->has('updatePage')) {
            return redirect()->route('assessmentEdit', ['shop' => $request->shop_id]);
        }else{
            return redirect('/');
        }
    }
}
