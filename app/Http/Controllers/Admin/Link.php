<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Links as LinksModels;
use Auth;
use Session;
use App\Helpers\Activity;

class Link extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['data'] = LinksModels::where('type', 'link')->get();
        $data['title'] = 'Menu';
        return view('admin.tautan.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = 'Tambah Tautan';
        return view('admin.tautan.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        $data = new LinksModels;

        $requestall = $request->all();
        $requestall['user_id'] = Auth::id();
        $requestall['role_id'] = '1';

        $data->fill($requestall);
        $save = $data->save();

        Activity::add([
            'page' => 'Menambah Tautan',
            'description' => 'Menambah Tautan '.$request->title
        ]);

        if ($save) {
            Session::flash('success','Menambah Tautan '.$request->title);
            return redirect()->route('link');
        }else{
            Session::flash('error','Gagal Menambah Tautan '.$request->title);
            return redirect()->route('link');
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
        $data['data'] = LinksModels::find($id);
        // dd($data['data']);
        $data['title'] = 'Edit Halaman';
        return view('admin.tautan.form', $data);
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
        $data = LinksModels::find($id);

        $requestall = $request->all();
        $requestall['user_id'] = Auth::id();
        $requestall['role_id'] = '1';

        $data->fill($requestall);
        $save = $data->update();

        Activity::add([
            'page' => 'Mengedit Tautan',
            'description' => 'Mengedit Tautan '.$request->title
        ]);

        if ($save) {
            Session::flash('success','Mengedit Tautan '.$request->title);
            return redirect()->route('link');
        }else{
            Session::flash('error','Gagal Mengedit Tautan '.$request->title);
            return redirect()->route('link');
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
        $data = LinksModels::find($id);
        $destroy = $data->delete();

        Activity::add([
            'page' => 'Menghapus Tautan',
            'description' => 'Menghapus Tautan '.$data->title
        ]);

        if ($destroy) {
            Session::flash('success','Menghapus Tautan '.$data->title);
            return redirect()->route('link');
        }else{
            Session::flash('error','Gagal Menghapus Tautan '.$data->title);
            return redirect()->route('link');
        }
    }
}
