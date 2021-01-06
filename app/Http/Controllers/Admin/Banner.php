<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Session;
use App\Helpers\Activity;
use Illuminate\Http\Request;
use App\Models\BannerAplikasi as ModelsBanner;
use Auth;

class Banner extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['data'] = ModelsBanner::get();
        $data['title'] = 'Banner';
        return view('admin.banner.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = 'Tambah Banner';
        return view('admin.banner.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        $data = new ModelsBanner;
        $gambar = $request->file('gambar');

        $gambar_name = 'banner'.time().$gambar->getClientOriginalName();
        $gambar->move(public_path().'/frontend/images/banner/', $gambar_name); 

        $data->gambar = $gambar_name;
        $data->title = $request->title;
        $data->url = $request->url;
        $data->order = $request->order;
        $data->uraian = $request->uraian;
        $data->user_id = Auth::id();
        $data->role_id = '1';

        $save = $data->save();

        Activity::add([
            'page' => 'Menambah Banner',
            'description' => 'Menambah Banner '.$request->title
        ]);

        if ($save) {
            Session::flash('success','Menambah Banner '.$request->title);
            return redirect()->route('banner');
        }else{
            Session::flash('error','Gagal Menambah Banner '.$request->title);
            return redirect()->route('banner');
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
        $data['data'] = ModelsBanner::find($id);
        // dd($data['data']);
        $data['title'] = 'Edit Halaman';
        return view('admin.banner.form', $data);
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
        $data = ModelsBanner::find($id);
        $gambar = $request->file('gambar');

        if (is_null($gambar)) {
                
        }else{
            $gambar_name = 'banner'.time().$gambar->getClientOriginalName();
            $gambar->move(public_path().'/frontend/images/banner/', $gambar_name); 
            $data->gambar = $gambar_name;
        }

        $data->title = $request->title;
        $data->url = $request->url;
        $data->order = $request->order;
        $data->uraian = $request->uraian;
        $data->user_id = Auth::id();
        $data->role_id = '1';

        $save = $data->update();

        Activity::add([
            'page' => 'Mengedit Banner',
            'description' => 'Mengedit Banner '.$request->title
        ]);

        if ($save) {
            Session::flash('success','Mengedit Banner '.$request->title);
            return redirect()->route('banner');
        }else{
            Session::flash('error','Gagal Mengedit Banner '.$request->title);
            return redirect()->route('banner');
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
        $data = ModelsBanner::find($id);
        $destroy = $data->delete();

        Activity::add([
            'page' => 'Menghapus Banner',
            'description' => 'Menghapus Banner '.$data->title
        ]);

        if ($destroy) {
            Session::flash('success','Menghapus Banner '.$data->title);
            return redirect()->route('banner');
        }else{
            Session::flash('error','Gagal Menghapus Banner '.$data->title);
            return redirect()->route('banner');
        }
    }
}
