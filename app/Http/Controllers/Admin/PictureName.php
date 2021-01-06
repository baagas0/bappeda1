<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri as GaleriModel;
use App\Models\Album as AlbumModels;
use Session;
use App\Helpers\Activity;

class PictureName extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['data'] = GaleriModel::get();
        $data['title'] = 'Menu';
        return view('admin.namafoto.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = 'Tambah Foto';
        $data['albums'] = AlbumModels::get();
        return view('admin.namafoto.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        $add = new GaleriModel;
        $add->ket = $request->ket;
        $add->idalbum = $request->idalbum;

        $gambar = $request->file('gambar');
        $gambar_name = 'galeri - '.time().$gambar->getClientOriginalName();
        $path = '/frontend/images/galeri/';
        $gambar->move(public_path().$path, $gambar_name);

        $add->urlpict = $path.$gambar_name;
        $save = $add->save();

        Activity::add([
            'page' => 'Menambah Foto Di Galeri Baru',
            'description' => 'Menambah Foto Di Galeri '.$request->ket
        ]);

        if ($save) {
            Session::flash('success','Menambah Foto Di Galeri '.$request->ket);
            return redirect()->route('picture');
        }else{
            Session::flash('error','Gagal Menambah Foto Di Galeri '.$request->ket);
            return redirect()->route('picture');
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
        $data['data'] = GaleriModel::findOrFail($id);
        $data['albums'] = AlbumModels::get();

        $data['title'] = 'Edit Halaman';
        return view('admin.namafoto.form', $data);
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
        $data = GaleriModel::findOrFail($id);
        $data->ket = $request->ket;
        $data->idalbum = $request->idalbum;

        $gambar = $request->file('gambar');

        if ($gambar) {
            $gambar_name = 'galeri - '.time().$gambar->getClientOriginalName();
            $path = '/frontend/images/galeri/';
            $gambar->move(public_path().$path, $gambar_name);
            $data->urlpict = $path.$gambar_name;
        }



        $save = $data->save();

        Activity::add([
            'page' => 'Mengedit Foto Di Galeri',
            'description' => 'Mengedit Foto Di Galeri '.$request->ket
        ]);

        if ($save) {
            Session::flash('success','Mengedit Foto Di Galeri '.$request->ket);
            return redirect()->route('picture');
        }else{
            Session::flash('error','Gagal Mengedit Foto Di Galeri '.$request->ket);
            return redirect()->route('picture');
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
        $data = GaleriModel::find($id);
        $destroy = $data->delete();

        if ($destroy) {
            Session::flash('success','Menghapus Foto Di Galeri '.$data->ket);
            return redirect()->route('picture');
        }else{
            Session::flash('error','Gagal Menghapus Foto Di Galeri '.$data->ket);
            return redirect()->route('picture');
        }
    }
}
