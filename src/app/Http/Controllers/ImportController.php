<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ShopsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function adminImport(Request $request) {
        Excel::import(new ShopsImport, $request->file('file'), null, \Maatwebsite\Excel\Excel::CSV);

        return redirect('/admin/index')->with('message', 'インポート完了しました');
    }
}
