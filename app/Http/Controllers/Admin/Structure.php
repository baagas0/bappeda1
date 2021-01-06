<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Structure as StructureModels;
use Auth;
use Session;
use App\Helpers\Activity;
use Illuminate\Support\Facades\Hash as Encrypt;
use Redirect;

class Structure extends Controller
{
    public function getIndex() {
        $data['title'] = 'Structure';
        $data['data'] = StructureModels::where('parent_id','=','0')
            ->get();
        return view('admin.structure.main', $data);
    }

    public function getAdd() {
        $data['title'] = 'Add Structure';
        return view('admin.structure.form', $data);
    }
    
    public function getCekUsername(Request $request) {
        $cek = StructureModels::where('username', $request->username)->first();
        
        if(empty($cek)) {
            $response = '<p style="color:#33FF00">Username tersedia</p>';
        }else {
            $response = '<p style="color:red">Username tidak tersedia</p>';
        }
        return $response;
    }

    public function postStore(Request $request) {
        $add = new StructureModels;
        $image  = $request->file('image');

        if ($image) {
            $image_name = 'image'.time().$image->getClientOriginalName();
            $path_thumb = '/backend/assets/images/image/';
            $image->move(public_path().$path_thumb, $image_name); 
            $add->image = $path_thumb.$image_name;
        }

        $add->name = $request->name;
        $add->position = $request->position;
        $add->parent_id = $request->parent_id;
        
        $add->nip = $request->nip;
        $add->id_bidang = $request->id_bidang;
        
        $data = StructureModels::get();
        foreach($data as $row) {
            if($row->username == $request->username) {
                Session::flash('error','Username '.$request->username.' Telah Di Gunakan');
                return Redirect::back();
            }
        }
        
        if(empty($request->username)) {
            $add->username = $request->nip;
        }else {
            $add->username = $request->username;
        }
        $add->password = Encrypt::make($request->password);
        $save = $add->save();
        
        $add->assignRole($request->role);
        
        Activity::add([
            'page' => 'Menambah Data Structure Baru',
            'description' => 'Menambah Data Structure Baru '.$request->name
        ]);

        if ($save) {
            Session::flash('success','Menambah Data Struktur Baru '.$request->name);
            return redirect()->route('structure');
        }else{
            Session::flash('error','Gagal Menambah Data Struktur Baru '.$request->name);
            return redirect()->route('structure');
        }
    }

    public function getEdit($id)
    {
        $data['data'] = StructureModels::find($id);
        // dd($data['data']);
        $data['title'] = 'Edit Halaman';
        return view('admin.structure.form', $data);
    }
    public function postUpdate(Request $request, $id) {
        $add = StructureModels::findOrFail($id);
        $image  = $request->file('image');

        if ($image) {
            $image_name = 'image'.time().$image->getClientOriginalName();
            $path_thumb = '/backend/assets/images/image/';
            $image->move(public_path().$path_thumb, $image_name); 
            $add->image = $path_thumb.$image_name;
        }

        $add->name = $request->name;
        $add->position = $request->position;
        $add->parent_id = $request->parent_id;
        
        $add->nip = $request->nip;
        $add->id_bidang = $request->id_bidang;
        
        $data = StructureModels::get();
        foreach($data as $row) {
            if($row->username == $request->username) {
                Session::flash('error','Username '.$request->username.' Telah Di Gunakan');
                return Redirect::back();
            }
        }
        
        if($request->username) {
        $add->username = $request->username;
        }
        if($request->password) {
        $add->password = Encrypt::make($request->password);
        }
        
        $save = $add->save();
        
        $add->assignRole($request->role);
        
        Activity::add([
            'page' => 'Mengedit Data Structure',
            'description' => 'Mengedit Data Structure '.$request->name
        ]);

        if ($save) {
            Session::flash('success','Mengedit Data Struktur '.$request->name);
            return redirect()->route('structure');
        }else{
            Session::flash('error','Gagal Mengedit Data Struktur '.$request->name);
            return redirect()->route('structure');
        }
    }

    public function getDestroy($id)
    {
        $data = StructureModels::findOrFail($id);
        $destroy = $data->delete();

        Activity::add([
            'page' => 'Menghapus Data Struktur',
            'description' => 'Menghapus Data Struktur '.$data->name
        ]);

        if ($destroy) {
            Session::flash('success','Menghapus Data Struktur '.$data->name);
            return redirect()->route('structure');
        }else{
            Session::flash('error','Gagal Menghapus Data Struktur '.$data->name);
            return redirect()->route('structure');
        }
    }
}
