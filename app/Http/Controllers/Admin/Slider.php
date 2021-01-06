<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider as SliderModels;
use Auth;
use Session;
use App\Helpers\Activity;

class Slider extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['data'] = SliderModels::get();
        $data['title'] = 'Slider';
        return view('admin.slider.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = 'Tambah Slider';
        return view('admin.slider.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        $data = new SliderModels;
        $gambar = $request->file('gambar');

        $gambar_name = 'slider'.time().$gambar->getClientOriginalName();
        $path = '/frontend/images/slider/';
        $gambar->move(public_path().$path, $gambar_name); 

        $data->gambar = $path.$gambar_name;
        $data->judul = $request->judul;
        $data->keterangan = $request->keterangan;
        $data->flag = $request->has('flag');
        $data->user_id = Auth::id();
        $data->role_id = '1';
        $save = $data->save();

        Activity::add([
            'page' => 'Menambah Slider',
            'description' => 'Menambah Slider '.$request->title
        ]);

        if ($save) {
            Session::flash('success','Menambah Slider '.$request->title);
            return redirect()->route('slider');
        }else{
            Session::flash('error','Gagal Menambah Slider '.$request->title);
            return redirect()->route('slider');
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
        $data['data'] = SliderModels::find($id);
        $data['title'] = 'Edit Slider';
        return view('admin.slider.form', $data);
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
        $data = SliderModels::find($id);
        $gambar = $request->file('gambar');

        if ($gambar) {
            $gambar_name = 'slider'.time().$gambar->getClientOriginalName();
            $gambar->move(public_path().'/image/slider/', $gambar_name); 
            $data->gambar = $gambar_name;
        }

        $data->judul = $request->judul;
        $data->keterangan = $request->keterangan;
        $data->flag = $request->has('flag');
        $data->user_id = Auth::id();
        $data->role_id = '1';
        $save = $data->save();

        Activity::add([
            'page' => 'Mengedit Banner',
            'description' => 'Mengedit Banner '.$request->title
        ]);

        if ($save) {
            Session::flash('success','Mengedit Banner '.$request->title);
            return redirect()->route('slider');
        }else{
            Session::flash('error','Gagal Mengedit Banner '.$request->title);
            return redirect()->route('slider');
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
        $data = SliderModels::find($id);
        $destroy = $data->delete();

        Activity::add([
            'page' => 'menghapus Banner',
            'description' => 'menghapus Banner '.$data->title
        ]);

        if ($destroy) {
            Session::flash('success','menghapus Banner '.$data->title);
            return redirect()->route('slider');
        }else{
            Session::flash('error','Gagal menghapus Banner '.$data->title);
            return redirect()->route('slider');
        }
    }
}
