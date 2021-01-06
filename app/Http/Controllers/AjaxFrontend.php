<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AjaxFrontend extends Controller
{
    public function postRkt(Request $request){
        $tanggal = $request->tanggal;
        return view('user.dokumen.table.rkt', $tanggal);
    }
}
