<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\MultiLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Shop;
use App\Models\Manager;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function multiIndex() {
        return view('multi.multi-login');
    }

    public function multiLogin(MultiLoginRequest $request) {
        $credentials = $request->only('email', 'password');
        $guard = $request->input('guard');

        if(Auth::guard($guard)->attempt($credentials)) {
            return redirect($guard . '/index');
        }

        return back()->withErrors( ['auth' => ['認証に失敗しました']] );
    }

    public function adminIndex() {
        $shops = Shop::all();

        return view('admin.admin', compact('shops'));
    }

    public function adminCreate(AdminRequest $request) {
        $manager = $request->only('shop_id', 'name', 'email',);
        $manager['password'] = Hash::make($request->password);
        $manager['email_verified_at'] = Carbon::now();

        Manager::create($manager);

        return redirect('/admin/index')->with('message', '登録完了しました');
    }
}
