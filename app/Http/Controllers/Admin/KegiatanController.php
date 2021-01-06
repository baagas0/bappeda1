<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Helpers\Activity;
use App\Models\Suggestion; 
use App\Models\Kegiatan_bidang;
use App\Models\Absensi;
use App\Models\Users;
use App\Models\Bidang;
use Auth;

class KegiatanController extends Controller
{
    public function getIndex() {
        $user = Users::where('id', Auth::user()->id)->first();
        foreach($user->roles->pluck('name') as $roles){
            if($roles == 'superadmin'){
                $role = 'superadmin';
                $data['role'] =  'superadmin';
            }else {
                $role = '';
                $data['role'] =  '';
            }
        }
        
        if($role == 'superadmin'){
            $data['data'] = Kegiatan_bidang::get(); 
            $data['bidangs'] = Bidang::whereNotIn('id', ['6'])->get();
        }else {
            $bidang = Bidang::where('route', $user->username)->first();
            $data['bidangs'] = Bidang::where('id', $bidang->id)->get();
            $data['data'] = Kegiatan_bidang::where('bidang_id', $bidang->id)->get(); 
        }
        
        
        return view('admin.bidang.kegiatan.main', $data);
    }
    
    public function postAdd(Request $request) {
        $user = Users::where('id', Auth::user()->id)->first();
        $bidang = Bidang::where('route', $user->username)->first();
        $add = new Kegiatan_bidang;
        $add->name = $request->name;
        $add->tanggal = $request->tanggal;
        $add->time = $request->time;
        $add->bidang_id = $request->bidang;
        $save = $add->save();
        
        Activity::add([
            'page' => 'Menambah Kegiatan',
            'description' => 'Menambah Kegiatan '.$request->name
        ]);
        
        if($save) {
            Session::flash('success','Gagal Menambah Data Kegiatan Baru '.$request->name);
            return redirect()->route('kegiatan');
        }else {
            Session::flash('success','Gagal Menambah Data Kegiatan Baru '.$request->name);
            return redirect()->route('kegiatan');
        }
    }
    
    public function postUpdate($id, Request $request) {
        $update = Kegiatan_bidang::findOrFail($id);
        $update->name = $request->name;
        $update->tanggal = $request->tanggal;
        $update->time = $request->time;
        $save = $update->save();
        
        Activity::add([
            'page' => 'Mengedit Kegiatan',
            'description' => 'Mengedit Kegiatan '.$request->name
        ]);
        
        if($save) {
            Session::flash('success','Gagal Mengedit Data Kegiatan Baru '.$request->name);
            return redirect()->route('kegiatan');
        }else {
            Session::flash('success','Gagal Mengedit Data Kegiatan Baru '.$request->name);
            return redirect()->route('kegiatan');
        }
        
        return redirect()->route('kegiatan');
    }
    
    public function getDelete($id) {
        $destroy = Kegiatan_bidang::findOrFail($id);
        $delete = $destroy->delete();
        
        Activity::add([
            'page' => 'Menghapus Kegiatan',
            'description' => 'Menghapus Kegiatan '.$destroy->name
        ]);
        
        if($delete) {
            Session::flash('success','Berhasil Menghapus Data Kegiatan Baru '.$destroy->name);
            return redirect()->route('kegiatan');
        }else {
            Session::flash('success','Gagal Menghapus Data Kegiatan Baru '.$destroy->name);
            return redirect()->route('kegiatan');
        }
    }
    
    public function postCreateAbsensi($id, Request $request) {
        $kegiatan_bidang = Kegiatan_bidang::findOrFail($id);
        $add = new Absensi;
        $add->kegiatan_bidang_id = $id;
        $add->link = $request->link;
        $add->bidang_id = $kegiatan_bidang->bidang_id;
        $save = $add->save();
        
        Activity::add([
            'page' => 'Pembuatan Absensi Kegiatan',
            'description' => 'Pembuatan Absensi Kegiatan '.$request->link
        ]);
        
        if($save) {
            Session::flash('success','Berhasil Membuat Absensi Kegiatan '.$request->link);
            return redirect()->route('kegiatan');
        }else {
            Session::flash('success','Gagal Membuat Absensi Kegiatan '.$request->link);
            return redirect()->route('kegiatan');
        }
        
    }
        public function getCekAbsensi(Request $request) {
            $cek = Absensi::where('link', $request->link)->first();
        
            if(empty($cek)) {
                $response = 1;
            }else {
                $response = 0;
            }
            return $response;
        }
        
    public function postCreateSuggestion($id, Request $request) {
        $kegiatan_bidang = Kegiatan_bidang::findOrFail($id);
        $add = new Suggestion;
        $add->kegiatan_bidang_id = $id;
        $add->link = $request->link;
        $add->bidang_id = $kegiatan_bidang->bidang_id;
        $save = $add->save();
        
        Activity::add([
            'page' => 'Pembuatan Pesan & Saran Kegiatan',
            'description' => 'Pembuatan Pesan & Saran Kegiatan '.$request->link
        ]);
        
        if($save) {
            Session::flash('success','Berhasil Membuat Pesan & Saran Kegiatan '.$request->link);
            return redirect()->route('kegiatan');
        }else {
            Session::flash('success','Gagal Membuat Pesan & Saran Kegiatan '.$request->link);
            return redirect()->route('kegiatan');
        } 
         
    }
        public function getCekSuggestion(Request $request) {
            $cek = Suggestion::where('link', $request->link)->first();
        
            if(empty($cek)) {
                $response = 1;
            }else {
                $response = 0;
            }
            return $response;
        }
}
