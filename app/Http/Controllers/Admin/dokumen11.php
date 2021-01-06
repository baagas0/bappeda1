<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Helpers\Activity;

class Ekonomi extends Controller
{
    public function getIndex()
    {
        $data['title'] = 'Ekonomi';

        $data['data'] = BidangFileModels::where('bidang_id', 2)->get();
        return view('admin.bidang.ekonomi.main', $data);
    }
}
