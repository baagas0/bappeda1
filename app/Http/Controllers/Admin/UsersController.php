<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Hash as encrypt;
use Session;
use App\Helpers\Activity;

class UsersController extends Controller
{
    public function getIndex() {
    	$data['data'] = Users::get();
        $data['title'] = 'Users Management';
        return view('admin.users.main', $data);
    }

    public function getCreate()
    {
        $data['title'] = 'Tambah User';
        return view('admin.users.form', $data);
    }

    public function postCreate(Request $request)
    {
    	$add = new Users;

    	$gambar = $request->file('photo');
        dd($gambar);

        $gambar_name = 'user'.time().$gambar->getClientOriginalName();
        $path = '/backend/assets/images/users/';
        $gambar->move(public_path().$path, $gambar_name);

        $add->photo = $path.$gambar_name;


    	$add->name = $request->name;
    	$add->username = $request->username;
    	$add->email = $request->email;
    	$add->password = encrypt::make($request->password);
    	$save = $add->save();

    	$add->assignRole($request->role);

    	Activity::add([
            'page' => 'Menambah User Baru',
            'description' => 'Menambah User Baru '.$request->name
        ]);

        if ($save) {
            Session::flash('success','Menambah User Baru '.$request->name);
            return redirect()->route('users');
        }else{
            Session::flash('error','Gagal Menambah User Baru '.$request->name);
            return redirect()->route('users');
        }
    }

    public function getEdit($id)
    {
        $data['data'] = Users::findOrFail($id);
        // dd($data['data']);
        $data['title'] = 'Edit User';
        return view('admin.users.form', $data);
    }

    public function postUpdate(Request $request, $id)
    {
    	if ($request->role == 'pilih') {
            Session::flash('error','Silahkan Pilih Role Terlebih Dahulu');
            return redirect()->route('users.edit',$id);   
    	}

    	$add = Users::findOrFail($id);

    	$gambar = $request->file('photo');

    	if ($gambar) {
        $gambar_name = 'user'.time().$gambar->getClientOriginalName();
        $path = '/backend/assets/images/users/'; 
        $gambar->move(public_path().$path, $gambar_name);

        $add->photo = $path.$gambar_name;
	    }


    	$add->name = $request->name;
    	$add->username = $request->username;
    	$add->email = $request->email;
    	$add->password = encrypt::make($request->password);
    	$save = $add->save();

    	$add->assignRole($request->role);

    	Activity::add([
            'page' => 'Mengedit User ',
            'description' => 'Mengedit User  '.$request->name
        ]);

        if ($save) {
            Session::flash('success','Mengedit User  '.$request->name);
            return redirect()->route('users');
        }else{
            Session::flash('error','Gagal Mengedit User  '.$request->name);
            return redirect()->route('users');
        }
    }

    public function getDestroy($id)
    {
        $data = Users::findOrFail($id);
        $destroy = $data->delete();

        Activity::add([
            'page' => 'Menghapus User',
            'description' => 'Menghapus User '.$data->name
        ]);

        if ($destroy) {
            Session::flash('success','Menghapus User '.$data->name);
            return redirect()->route('users');
        }else{
            Session::flash('error','Gagal Menghapus User '.$data->name);
            return redirect()->route('users');
        }
    }
}
