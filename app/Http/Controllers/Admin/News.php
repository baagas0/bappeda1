<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\News as NewsModels;
use Auth;
use Session;
use App\Helpers\Activity;

class News extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['data'] = DB::table('news')
                        ->select('news.id','news.judul','news.pengantar','news.flag','news.created_at','news.user_id','users.name')
                        ->join('users','users.id','=','news.user_id')
                        ->orderby('created_at','desc')
                        ->paginate(10);
        $data['title'] = 'News';
        return view('admin.module.news.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = 'Tambah Berita';
        return view('admin.module.news.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        $data = new NewsModels;
        $data->judul = $request->judul;
        $data->pengantar = $request->pengantar;
        $data->isi = $request->isi;
        $data->sumber = $request->sumber;
        $data->warna = $request->warna;
        $data->ukuran = $request->ukuran;
        $data->flag = $request->has('flag');
        $data->urltitle = str_replace(' ', '-', $data->judul = $request->judul);
        $data->user_id = Auth::id();
        $data->role_id = '1';
        $save = $data->save();

        if ($save) {
            toastr()->success('Data Berita : '.$request->judul.' Berhasil Di Simpan');
            return redirect()->route('news');
        }else{
            toastr()->erorr('Data Berita : '.$request->judul.' Gagal Di Simpan');
            return redirect()->route('news');
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
        $data['data'] = NewsModels::find($id);
        // dd($data['data']);
        $data['title'] = 'Edit Halaman';
        return view('admin.module.news.form', $data);
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
        $data = NewsModels::find($id);
        $data->judul = $request->judul;
        $data->pengantar = $request->pengantar;
        $data->isi = $request->isi;
        $data->sumber = $request->sumber;
        $data->warna = $request->warna;
        $data->ukuran = $request->ukuran;
        $data->flag = $request->has('flag');
        $data->urltitle = str_replace(' ', '-', $data->judul = $request->judul);
        $data->user_id = Auth::id();
        $data->role_id = '1';
        $save = $data->save();

        if ($save) {
            toastr()->success('Data Berita : '.$request->judul.' Berhasil Di Edit');
            return redirect()->route('news');
        }else{
            toastr()->erorr('Data Berita : '.$request->judul.' Gagal Di Edit');
            return redirect()->route('news');
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
        $data = NewsModels::find($id);
        $destroy = $data->delete();

        if ($destroy) {
            toastr()->success('Data Berita : '.$request->judul.' Berhasil Di Hapus');
            return redirect()->route('news');
        }else{
            toastr()->erorr('Data Berita : '.$request->judul.' Gagal Di Hapus');
            return redirect()->route('news');
        }
    }
}
