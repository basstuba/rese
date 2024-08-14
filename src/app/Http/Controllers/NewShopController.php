<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ManagerRequest;
use App\Models\Shop;
use App\Models\Manager;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Image;

class NewShopController extends Controller
{
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

    public function managerCreate(ManagerRequest $request) {
        $shop = $request->only('name', 'img_url', 'area', 'genre', 'comment');
        Shop::create($shop);

        $managerId = $request->only('managerId');
        if(!empty($managerId['managerId'])) {
            $newShop = Shop::latest()->where('name', $shop['name'])->first();
            $newShopId['shop_id'] = $newShop['id'];

            Manager::find($managerId['managerId'])->update($newShopId);
        }

        return redirect('/manager/new')->with('message', '作成完了しました');
    }
}
