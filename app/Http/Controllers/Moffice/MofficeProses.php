<?php

namespace App\Http\Controllers\Moffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bidang as BidangModels;
use App\Models\Structure as StructureModels;
use App\Models\Notification as NotificationModels;
use App\Helpers\ApiData;
use App\Models\Mruangrapat as RuangRapat;
use App\Models\Mzoom as Zoom;
use Auth;
use DB;
use Session;
use Hash as Encrypt;

class MofficeProses extends Controller
{
    public function postAjaxSuratAll(Request $request) {
        $data['tanggal'] = $request->tanggal;
        return view('moffice.surat.alldata', $data);
    }
    public function postAjaxRapat(Request $request) {
        $data['data'] = RuangRapat::where('tanggal', $request->tanggal)->orderBy('created_at', 'ASC')->get();
        $tanggal = $request->tanggal;
        $data['dataCount'] = count($data['data']);
        return view('moffice.rapat.dataruang', $data);
    } 
    
    public function postDelete(Request $request) {
        DB::table($request->table)->delete($request->id);
        return 'deleted';
    }
     
    public function getUsersUp($id) {
        $data['data']= StructureModels::findOrFail($id);
        return view('moffice.user.form', $data);
    }
    
    public function postAddRapat(Request $request) {
        $add = new RuangRapat;
        $add->bidang_id = Auth::user()->id_bidang;
        $add->user_id = Auth::user()->id;
        $add->tanggal = $request->tanggal;
        $add->jam_mulai = $request->jam_mulai;
        $add->jam_selesai = $request->jam_selesai;
        $add->kegiatan = $request->kegiatan;
        $add->peminjam = $request->peminjam;
        $add->keterangan = $request->keterangan;
        //dd(json_encode($request->ruang));
        $add->ruang = json_encode($request->ruang);
        $add->save();
        return 'Data Berhasil Masuk, Silahkan Lanjutkan Kerja Anda ^_^';
    }
    
    
    
    public function postDataRuangForm(Request $request, $form) {
        if($form == 'add') {
            DB::table('m_ruang')->insert([
                'name' => $request->name,
            ]);
        }else {
            DB::table('m_ruang')->where('id', $request->id)->update([
                'name' => $request->name,
            ]);
        }
        
        return redirect()->route('.moffice.data.ruang');
    }
    
    public function postAddZoom(Request $request) {
        $add = new Zoom;
        $add->bidang_id = Auth::user()->id_bidang;
        $add->user_id = Auth::user()->id;
        $add->tanggal = $request->tanggal;
        $add->jam_mulai = $request->jam_mulai;
        $add->jam_selesai = $request->jam_selesai;
        $add->kegiatan = $request->kegiatan;
        $add->peminjam = $request->peminjam;
        $add->keterangan = $request->keterangan;
        
        if($request->jenis == 'akun') {
            $add->jenis = 'Peminjaman Akun Zoom';
        }else {
            $add->jenis = 'Peminjaman Barang';
        
            $add->barang = json_encode($request->barang);
        }
        $save = $add->save();
        return 'Data Berhasil Masuk, Silahkan Lanjutkan Kerja Anda ^_^';
    }
    
    public function postAjaxZoom(Request $request) {
        $data['data'] = Zoom::where('tanggal', $request->tanggal)->orderBy('created_at', 'ASC')->get();
        $data['dataCount'] = count($data['data']);
        return view('moffice.zoom.dataruang', $data);
    }
    
    public function postDataBarangForm($form, Request $request) {
        if($form == 'add') {
            DB::table('m_barang')->insert([
                'name' => $request->name,
            ]);
        }else {
            DB::table('m_barang')->where('id', $request->id)->update([
                'name' => $request->name,
            ]);
        }
        
        return redirect()->route('.moffice.data.barang');
    }
    public function postUpUser(Request $request, $id) {
        $up = StructureModels::findOrFail($id);
        $up->nip = $request->nip;
        $up->name = $request->name;
        $up->position = $request->position;
        $up->username = $request->username;
        
        if($request->password) {
            $up->password = Encrypt($request->password);
        }
        
        $save = $up->save();
        if($save){
            Session::flash('alert','Data Berhasil Di Simpan');
            
            $notif = NotificationModels::get();
            foreach($notif as $n){
                $data['phone_no'] = $n->nomor; 
                $data['message'] = 'Pengeditan data user pada applikasi MOFFICE untuk ID : '.$id;
                ApiData::wa($data);
            }
        }
        return redirect()->route('.moffice.users');
    }
    public function getDelUsers($id) {
        $data = StructureModels::find($id);
        $destroy = $data->delete();
        
        if($destroy){
            Session::flash('alert','Data Berhasil Di Hapus');
            $notif = NotificationModels::get();
            foreach($notif as $n){
                $data['phone_no'] = $n->nomor; 
                $data['message'] = 'Penghapusan data user pada applikasi MOFFICE oleh '.Auth::user()->username;
                ApiData::wa($data);
            }
        }
        return redirect()->route('.moffice.users');
    }
    public function getDelDataRuang($id) {
        DB::table('m_ruang')->where('id', $id)->delete();
        return redirect()->route('.moffice.data.ruang');
    }
    public function getDelDataBarang($id) {
        DB::table('m_barang')->where('id', $id)->delete();
        return redirect()->route('.moffice.data.barang');
    }
}
