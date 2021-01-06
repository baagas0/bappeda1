<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgendaKegiatan as AgendaKegiatanModels;
use Auth;
use Session;
use App\Helpers\Activity;

class UploadMaterial extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['data'] = AgendaKegiatanModels::get();
        $data['title'] = 'Menu';
        return view('admin.module.upload-material.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = 'Tambah Agenda';
        return view('admin.module.upload-material.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        $data = new AgendaKegiatanModels;
        $file = $request->file('file');

        $file_name = 'banner'.time().$file->getClientOriginalName();
        $file->move(public_path().'/file/upload-material/', $file_name); 

        $data->file = $file_name;
        $data->nama = $request->nama;
        $data->kegiatan = $request->kegiatan;
        $data->tgl = date('Y-m-d');
        $data->jam = date('H:i:s');
        $data->user_id = Auth::id();
        $data->role_id = '1';
        $save = $data->save();

        if ($save) {
            toastr()->success('Data : '.$request->nama.' Berhasil Di Simpan');
            return redirect()->route('upload-material');
        }else{
            toastr()->erorr('Data : '.$request->nama.' Gagal Di Simpan');
            return redirect()->route('upload-material');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $data['data'] = AgendaKegiatanModels::find($id);
        // dd($data['data']);
        $data['title'] = 'Edit Halaman';
        return view('admin.module.upload-material.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, $id)
    {
        $data = AgendaKegiatanModels::find($id);
        $file = $request->file('file');

        if ($file) {
            $file_name = 'banner'.time().$file->getClientOriginalName();
            $file->move(public_path().'/file/upload-material/', $file_name); 
            $data->file = $file_name;
        }

        $data->nama = $request->nama;
        $data->kegiatan = $request->kegiatan;
        $data->updated_at = date('Y-m-d H:i:s');
        $data->user_id = Auth::id();
        $data->role_id = '1';
        $save = $data->update();

        if ($save) {
            toastr()->success('Data : '.$request->nama.' Berhasil Di Edit');
            return redirect()->route('upload-material');
        }else{
            toastr()->erorr('Data : '.$request->nama.' Gagal Di Edit');
            return redirect()->route('upload-material');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDestroy($id)
    {
        $data = AgendaKegiatanModels::find($id);
        $destroy = $data->delete();

        if ($destroy) {
            toastr()->success('Data : '.$data->nama.' Berhasil Di Hapus');
            return redirect()->route('upload-material');
        }else{
            toastr()->erorr('Data : '.$data->nama.' Gagal Di Hapus');
            return redirect()->route('upload-material');
        }
    }
}
