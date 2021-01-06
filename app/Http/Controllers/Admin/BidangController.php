<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BidangFile as BidangFileModels;
use App\Models\Users as UserModels;
use App\Models\Roles as RoleModels;
use App\Models\Bidang as BidangModels;
use Auth;
use Session;
use App\Helpers\Activity;

class BidangController extends Controller
{
    public function getIndex()
    {
    	$user = UserModels::findOrFail(Auth::user()->id);
    	$roles = $user->roles->pluck('id');
    	foreach ($roles as $d) {
	    	$role = $d;
    	}
		   	// $role_id = RoleModels::where('name', $d)->first();
	    	// dd($role);

        $data['title'] = 'BPSB';

        if ($role == 1) {
	        $data['data'] = BidangFileModels::get();
        }else{
        	$b = BidangModels::where('route', $user->username)->first();
        	// dd($user);
	        $data['data'] = BidangFileModels::where('bidang_id', $b->id)->get();
        }

        return view('admin.bidang.bpsb.main', $data);
    }

    public function getAdd()
    {
    	$user = Auth::user()->username;
    	$user1 = UserModels::findOrFail(Auth::user()->id);
    	$roles = $user1->roles->pluck('id');
    	foreach ($roles as $d) {
	    	$role = $d;
    	}

    	if ($d == 3) {
    		$data['b'] = BidangModels::where('route', $user)->get();
    	}elseif ($d == 1) {
    		$data['b'] = BidangModels::get();
    	}
    	// dd($data['b']);
        $data['title'] = 'Tambah Data Bidang';
        return view('admin.bidang.bpsb.form', $data);
    }

    public function postStore(Request $request)
    {

    	$user = Auth::user()->username;
    	
    	$user1 = UserModels::findOrFail(Auth::user()->id);
    	$roles = $user1->roles->pluck('id');
    	foreach ($roles as $d) {
	    	$role = $d;
    	}

    	if ($d == 1) {
    		$bidang_id = array('bidang' => 'custom superadmin');
    	}elseif ($d == 3) {
    		$bidang_id = BidangModels::where('route', $user)->first();
    	}

    	if (empty($bidang_id)) {
    		Activity::add([
	            'page' => 'Percobaan Melampui Role Permisson',
	            'description' => 'Bidang '.$user.' Mencoba Memasukan Data Ke Bidang Lain'
	        ]);

    		Session::flash('error','Anda Tidak Punya Akses Untuk Memasukan Data Ke Bidang Lain ');
            return redirect()->route('bidang-manage');
    	}else{
    		$data = new BidangFileModels;
	        $data->bidang_id = $request->bidang_id;
	        $data->title = $request->title;
	        $data->description = $request->description;

	        $file = $request->file('file');

	        $file_name = 'bidang'.time().$file->getClientOriginalName();
	        $path = '/backend/assets/images/bidang/1/';
	        $file->move(public_path().$path, $file_name);
	        $data->file = $path.$file_name; 

	        $save = $data->save();

	        Activity::add([
	            'page' => 'Menambah Data Baru Milik BPSB',
	            'description' => 'Menambah Data Baru Milik BPSB '.$request->title
	        ]);

	        if ($save) {
	            Session::flash('success','Menambah Data Baru Milik BPSB '.$request->title);
	            return redirect()->route('bidang-manage');
	        }else{
	            Session::flash('error','Gagal Menambah Data Baru Milik BPSB '.$request->title);
	            return redirect()->route('bidang-manage');
	        }
    	}
    }
}
