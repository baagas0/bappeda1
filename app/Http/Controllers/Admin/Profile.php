<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users as User;
use Auth;
use Session;
use App\Helpers\Activity;
use Validator;
use Illuminate\Support\Facades\Hash;

class Profile extends Controller
{
    public function getIndex()
    {
        $data['data'] = User::findOrFail(Auth::id());
        $data['title'] = 'Menu';
        return view('admin.profile.main', $data);
    }

    public function postUpdate(Request $request)
    {
    	if (Hash::check($request->password, Auth::user()->password)) {
	        $data = User::findOrFail(Auth::user()->id);
	        $data->name = $request->name;
	        $data->description = $request->description;
	        $gambar = $request->file('photo');

	        if ($gambar) {
		        $gambar_name = 'banner'.time().$gambar->getClientOriginalName();
		        $path = '/backend/assets/images/users/';
		        $gambar->move(public_path().$path, $gambar_name); 
		        $data->photo = $path.$gambar_name;
	        }


	        $save = $data->update();
	        // dd($data);
	        Activity::add([
	            'page' => 'Mengedit Info Profile',
	            'description' => 'Mengedit Profile '.$data->name
	        ]);

	        if ($save) {
	            Session::flash('success','Mengedit Profile '.$data->name);
	            return redirect()->route('profile');
	        }else{
	            Session::flash('error','Gagal Mengedit Profile '.$data->name);
	            return redirect()->route('profile');
	        }
        }else{
        	Session::flash('error','Password Yang Anda Masukan Salah');
	            return redirect()->route('profile');
        }
    }
}
