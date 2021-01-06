<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori as KategoriModels;
use Auth;
use Session;
use App\Helpers\Activity;

class Category extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['data'] = KategoriModels::orderBy('id','DESC')->get();
        $data['title'] = 'Kategori';
        return view('admin.artikel.kategori.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = 'Tambah Kategori';
        return view('admin.artikel.kategori.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        $data = new KategoriModels;
        $data->kategori = $request->kategori;
        $data->user_id = Auth::id();
        $data->role_id = '1';
        $save = $data->save();

        if ($save) {
            toastr()->success('Data Kategori : '.$request->kategori.' Berhasil Di Simpan');
            return redirect()->route('category');
        }else{
            toastr()->erorr('Data Kategori : '.$request->kategori.' Gagal Di Simpan');
            return redirect()->route('category');
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
        $data['data'] = KategoriModels::find($id);
        // dd($data['data']);
        $data['title'] = 'Edit Halaman';
        return view('admin.artikel.kategori.form', $data);
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
        $data = KategoriModels::find($id);
        $data->kategori = $request->kategori;
        $data->user_id = Auth::id();
        $data->role_id = '1';
        $save = $data->save();

        if ($save) {
            toastr()->success('Data Kategori : '.$request->kategori.' Berhasil Di Simpan');
            return redirect()->route('category');
        }else{
            toastr()->erorr('Data Kategori : '.$request->kategori.' Gagal Di Simpan');
            return redirect()->route('category');
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
        $data = KategoriModels::find($id);
        $destroy = $data->delete();

        if ($destroy) {
            toastr()->success('Data Page : '.$data->kategori.' Berhasil Di Hapus');
            return redirect()->route('category');
        }else{
            toastr()->erorr('Data Page : '.$data->kategori.' Gagal Di Hapus');
            return redirect()->route('category');
        }
    }
}
