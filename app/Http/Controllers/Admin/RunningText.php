<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RunningText as ModelsRunningText;
use Auth;
use Session;
use App\Helpers\Activity;

class RunningText extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['data'] = ModelsRunningText::get();
        $data['title'] = 'Menu';
        return view('admin.run-text.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = 'Tambah Text Berjalan';
        return view('admin.run-text.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        $data = new ModelsRunningText;
        $data->running_text = $request->running_text;
        $data->user_id = Auth::id();
        $data->role_id = '1';
        $save = $data->save();

        Activity::add([
            'page' => 'Menambah Text Berjalan',
            'description' => 'Menambah Text Berjalan '.$request->running_text
        ]);

        if ($save) {
            Session::flash('success','Menambah Text Berjalan '.$request->running_text);
            return redirect()->route('run-text');
        }else{
            Session::flash('error','Gagal Menambah Text Berjalan '.$request->running_text);
            return redirect()->route('run-text');
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
        $data['data'] = ModelsRunningText::find($id);
        // dd($data['data']);
        $data['title'] = 'Edit Halaman';
        return view('admin.run-text.form', $data);
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
        $data = ModelsRunningText::find($id);
        $data->running_text = $request->running_text;
        $data->user_id = Auth::id();
        $data->role_id = '1';
        $save = $data->save();

        Activity::add([
            'page' => 'Mengedit Text Berjalan',
            'description' => 'Mengedit Text Berjalan '.$data->running_text
        ]);

        if ($save) {
            Session::flash('success','Mengedit Text Berjalan '.$data->running_text);
            return redirect()->route('run-text');
        }else{
            Session::flash('error','Gagal Mengedit Text Berjalan '.$data->running_text);
            return redirect()->route('run-text');
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
        $data = ModelsRunningText::find($id);
        $destroy = $data->delete();

        Activity::add([
            'page' => 'Menghapus Text Berjalan',
            'description' => 'Menghapus Text Berjalan '.$data->running_text
        ]);

        if ($destroy) {
            Session::flash('success','Menghapus Text Berjalan '.$data->running_text);
            return redirect()->route('run-text');
        }else{
            Session::flash('error','Gagal Menghapus Text Berjalan '.$data->running_text);
            return redirect()->route('run-text');
        }
    }
}
