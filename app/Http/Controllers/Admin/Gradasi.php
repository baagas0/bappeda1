<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Helpers\Activity;

class Gradasi extends Controller
{
    public function getIndex()
    {
    	$data['data'] = DB::connection('gradasi')->table('prestasi')
    					->orderBy('tahun', 'DESC')->get();

        $data['title'] = 'Gradasi';
        return view('admin.gradasi.main', $data);
    }
}
