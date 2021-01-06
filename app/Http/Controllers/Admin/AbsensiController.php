<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Absensi_list;
use App\Models\Kegiatan_bidang;
use App\Models\Users;
use App\Models\Bidang;
use Auth;

class AbsensiController extends Controller
{
    public function getIndex() {
        $user = Users::where('id', Auth::user()->id)->first();
        foreach($user->roles->pluck('name') as $roles){
            if($roles == 'superadmin'){
                $role = 'superadmin';
            }else {
                $role = '';
            }
        }
        if($role == 'superadmin') {
            $data['absensi'] = Absensi::get();
        }else {
            $bidang = Bidang::where('route', $user->username)->first();
            $data['absensi'] = Absensi::where('bidang_id', $bidang->id)->get();
        }
        return view('admin.absensi.main', $data);
    }
    
    public function postAjaxAbsensi(Request $request) {
        $absensi = Absensi::where('id', $request->kegiatanbidang)->first();
        $data['absensi_list'] = Absensi_list::where('absensi_id', $request->kegiatanbidang)->get();
        $data['kegiatan_bidang'] = Kegiatan_bidang::where('id', $absensi->kegiatan_bidang_id)->first();
        return view('admin.absensi.ajax', $data);
    }
}
