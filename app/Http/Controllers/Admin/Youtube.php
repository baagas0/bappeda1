<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video as VidioModels;
use Session;
use App\Helpers\Activity;

class Youtube extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['data'] = VidioModels::get();
        $data['title'] = 'Embed Youtube';
        return view('admin.youtube.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = 'Tambah Embed Youtube';
        return view('admin.youtube.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        $data = new VidioModels;
        $data->url = $request->url;
        $data->flag = $request->has('flag');
        $save = $data->save();

        Activity::add([
            'page' => 'Menambah Youtube',
            'description' => 'Menambah Tautan Youtube'
        ]);

        if ($save) {
            Session::flash('success','Menambah Tautan Youtube');
            return redirect()->route('youtube');
        }else{
            Session::flash('error','Gagal Menambah Tautan Youtube');
            return redirect()->route('youtube');
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
        $data['data'] = VidioModels::find($id);
        // dd($data['data']);
        $data['title'] = 'Edit Embed Youtube';
        return view('admin.youtube.form', $data);
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
        $data = VidioModels::find($id);
        $data->url = $request->url;
        $data->flag = $request->has('flag');
        $save = $data->save();

        Activity::add([
            'page' => 'Mengedit Youtube',
            'description' => 'Mengedit Tautan Youtube'
        ]);

        if ($save) {
            Session::flash('success','Mengedit Tautan Youtube');
            return redirect()->route('youtube');
        }else{
            Session::flash('error','Gagal Mengedit Tautan Youtube');
            return redirect()->route('youtube');
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
        $data = VidioModels::find($id);
        $destroy = $data->delete();

        Activity::add([
            'page' => 'Menghapus Youtube',
            'description' => 'Menghapus Tautan Youtube'
        ]);

        if ($destroy) {
            Session::flash('success','Menghapus Tautan Youtube');
            return redirect()->route('youtube');
        }else{
            Session::flash('error','Gagal Menghapus Tautan Youtube');
            return redirect()->route('youtube');
        }
    }
}
