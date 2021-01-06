<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BukuTamu as BukuTamuModels;
use Session;
use App\Helpers\Activity;

class GuestBook extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['data'] = BukuTamuModels::orderBy('id')->get();
        $data['title'] = 'Menu';
        return view('admin.module.guestbook.main', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $data['data'] = BukuTamuModels::find($id);
        // dd($data['data']);
        $data['title'] = 'Edit Halaman';
        return view('admin.module.guestbook.form', $data);
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
        $data = BukuTamuModels::find($id);
        $data->tanggapan = $request->tanggapan;
        $save = $data->Update();

        if ($save) {
            toastr()->success('Data Buku Tamu : '.$request->nama.' Berhasil Di Edit');
            return redirect()->route('guest-book');
        }else{
            toastr()->erorr('Data Buku Tamu : '.$request->nama.' Gagal Di Edit');
            return redirect()->route('guest-book');
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
        $data = BukuTamuModels::find($id);
        $destroy = $data->delete();

        if ($destroy) {
            toastr()->success('Data Nama : '.$data->nama.' Berhasil Di Hapus');
            return redirect()->route('guest-book');
        }else{
            toastr()->erorr('Data Nama : '.$data->nama.' Gagal Di Hapus');
            return redirect()->route('guest-book');
        }
    }
}
