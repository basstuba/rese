<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use App\Models\User;

class LikeController extends Controller
{
    public function likeCreate(Request $request) {
        $favorite = $request->only('user_id', 'shop_id');

        Favorite::create($favorite);

        return redirect('/');
    }

    public function likeDelete(Request $request) {
        Favorite::find($request->id)->delete();

        if($request->has('myPage')) {
            return redirect('/link/user');
        }else{
            return redirect('/');
        }
    }
}
