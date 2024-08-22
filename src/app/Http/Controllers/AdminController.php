<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\MultiLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Shop;
use App\Models\Manager;
use App\Models\Assessment;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function multiLogin(MultiLoginRequest $request) {
        $credentials = $request->only('email', 'password');
        $guard = $request->input('guard');

        if(Auth::guard($guard)->attempt($credentials)) {
            return redirect($guard . '/index');
        }

        return back()->withErrors( ['auth' => ['認証に失敗しました']] );
    }

    public function adminNewManager() {
        $shops = Shop::all();

        return view('admin.manager_create', compact('shops'));
    }

    public function adminCreate(AdminRequest $request) {
        $manager = $request->only('shop_id', 'name', 'email',);
        $manager['password'] = Hash::make($request->password);
        $manager['email_verified_at'] = Carbon::now();

        Manager::create($manager);

        return redirect('/admin/new/manager')->with('message', '登録完了しました');
    }

    public function adminShopAssessment() {
        $shops = Shop::all();

        return view('admin.shop_assessment', compact('shops'));
    }

    public function adminAssessment($shopId) {
        $shop = Shop::find($shopId);
        $assessments = Assessment::orderBy('updated_at', 'desc')->where('shop_id', $shopId)->get();

        return view('admin.assessment', compact('shop', 'assessments'));
    }

    public function adminAssessmentDelete(Request $request) {
        Assessment::find($request->assessment_id)->delete();

        return redirect()->route('adminAssessment', ['shop' => $request->shop_id])->with('message', '削除しました');
    }
}
