<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Models\Shop;
use App\Models\Manager;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function adminIndex() {
        $shops = Shop::all();

        return view('admin.admin', compact('shops'));
    }
}
