<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ManagerRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Manager;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Image;

class EditShopController extends Controller
{
    public function managerEdit($shopId) {
        $shop = Shop::find($shopId);
        $areas = Area::all();
        $genres = Genre::all();
        $images = Image::all();
        $managers = Manager::all();
        $user = Auth::user();

        return view('admin.shop-update', compact('shop', 'areas', 'genres', 'images', 'managers', 'user'));
    }

    public function showEdit(Request $request) {
        $managerId = $request->only('shopManager');
        $shopManager = !empty($managerId) ? Manager::find($managerId['shopManager']) : null ;

        $user = Auth::user();
        $managerName = $shopManager ? $shopManager->name : $user['name'] ;

        return redirect()->route('managerEdit', ['store' => $user['shop_id']])->withInput()->with('managerName', $managerName);
    }

    public function managerUpdate(ManagerRequest $request) {
        $edit = $request->only('name', 'img_url', 'area', 'genre', 'comment');
        Shop::find($request->shop_id)->update($edit);

        $shopId = $request->only('shop_id');

        return redirect()->route('managerEdit', ['store' => $shopId['shop_id']])->with('message', '更新完了しました');
    }
}
