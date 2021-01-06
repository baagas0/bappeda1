<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Links as LinksModels;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Igfeed;
use Auth;


class IndexController extends Controller
{
    public function pemuda()
    {
    	$data['users'] = Users::all();
    	$data['users_count'] = count(Users::all());

    	$data['igs'] = Igfeed::orderBy('id_ig', 'DESC')->limit(3)->where('is_active', 1)->where('type', 'image')->get();
		return view('admin.index', $data);
	}
}
