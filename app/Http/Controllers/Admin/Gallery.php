<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri as GaleriModel;
use App\Models\Album as AlbumModel;
use Session;
use App\Helpers\Activity;

class Gallery extends Controller
{

    protected $galeri;

    public function __construct(AlbumModel $galeri){
        $this->galeri = $galeri;
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['data'] = $this->galeri
            ->select('album.id','album.album','album.lokasi','album.created_at','album.user_id','users.name',\DB::raw('COUNT(galeri.urlpict) as jmlfoto'))
            ->join('users','users.id','=','album.user_id')
            ->join('galeri','galeri.idalbum','=','album.id')
            ->groupby('album.id')
            ->orderby('album.created_at','desc')->get();

        
        $data['title'] = 'Menu';
        // dd($data['data']);
        return view('admin.galery.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = 'Tambah Halaman';
        return view('admin.galery.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        $data = new AlbumModel;
        $data->urltitle =  str_replace(' ','-',strtolower($request->album));
        $data->album = $request->album;
        $data->lokasi = $request->lokasi;
        $save = $data->save();

        Activity::add([
            'page' => 'Menambah Galeri Album Baru',
            'description' => 'Menambah Galeri Album '.$request->album
        ]);

        if ($save) {
            Session::flash('notif','Nama album akan muncul setelah anda menambahkan minimal satu foto di menu FOTO ');
            Session::flash('success','Menambah Galeri Album '.$request->album);
            return redirect()->route('album');
        }else{
            Session::flash('error','Gagal Menambah Galeri Album '.$request->album);
            return redirect()->route('album');
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
        $data['data'] = AlbumModel::findOrFail($id);
        // dd($data['data']);
        $data['title'] = 'Edit Halaman';
        return view('admin.galery.form', $data);
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
        $data = new AlbumModel;
        $data->urltitle =  str_replace(' ','-',strtolower($request->album));
        $data->album = $request->album;
        $data->lokasi = $request->lokasi;
        $save = $data->save();

        Activity::add([
            'page' => 'Mengedit Galeri Album Baru',
            'description' => 'Mengedit Galeri Album '.$request->album
        ]);

        if ($save) {
            Session::flash('notif','Nama album akan muncul setelah anda menambahkan minimal satu foto di menu FOTO ');
            Session::flash('success','Mengedit Galeri Album '.$request->album);
            return redirect()->route('album');
        }else{
            Session::flash('error','Gagal Mengedit Galeri Album '.$request->album);
            return redirect()->route('album');
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
        $data = AlbumModel::find($id);
        $destroy = $data->delete();

        Activity::add([
            'page' => 'Menghapus Galeri Album Baru',
            'description' => 'Menghapus Galeri Album '.$data->album
        ]);

        if ($destroy) {
            Session::flash('notif','Nama album akan muncul setelah anda menambahkan minimal satu foto di menu FOTO ');
            Session::flash('success','Menghapus Galeri Album '.$data->album);
            return redirect()->route('album');
        }else{
            Session::flash('error','Gagal Menghapus Galeri Album '.$data->album);
            return redirect()->route('album');
        }
    }
}
