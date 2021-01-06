<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BidangFile as BidangFileModels;
use Auth;
use Session;
use App\Helpers\Activity;

class Ppe extends Controller
{
    public function getIndex()
    {
        $data['title'] = 'PPE';

        $data['data'] = BidangFileModels::where('bidang_id', 4)->get();
        return view('admin.bidang.ppe.main', $data);
    }

    public function getAdd()
    {
        $data['title'] = 'Tambah PPE';
        return view('admin.bidang.ppe.form', $data);
    }

    public function postStore(Request $request)
    {
        $data = new BidangFileModels;
        $data->bidang_id = 4;
        $data->title = $request->title;
        $data->description = $request->description;

        $file = $request->file('file');

        $file_name = 'bidang'.time().$file->getClientOriginalName();
        $path = '/backend/assets/images/bidang/4/';
        $file->move(public_path().$path, $file_name);
        $data->file = $path.$file_name; 

        $save = $data->save();

        Activity::add([
            'page' => 'Menambah Data Baru Milik PPE',
            'description' => 'Menambah Data Baru Milik PPE '.$request->title
        ]);

        if ($save) {
            Session::flash('success','Menambah Data Baru Milik PPE '.$request->title);
            return redirect()->route('ppe');
        }else{
            Session::flash('error','Gagal Menambah Data Baru Milik PPE '.$request->title);
            return redirect()->route('ppe');
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
        $data['data'] = BidangFileModels::find($id);
        // dd($data['data']);
        $data['title'] = 'Edit Halaman';
        return view('admin.bidang.ppe.form', $data);

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
        $data = BidangFileModels::findOrFail($id);
        $data->title = $request->title;
        $data->description = $request->description;

        $file = $request->file('file');
        if ($file) {

        $file_name = 'bidang'.time().$file->getClientOriginalName();
        $path = '/backend/assets/images/bidang/4/';
        $file->move(public_path().$path, $file_name);
        $data->file = $path.$file_name; 
	    }

        $update = $data->save();

        Activity::add([
            'page' => 'Mengedit Data Milik PPE',
            'description' => 'Mengedit Data Milik PPE '.$request->title
        ]);

        if ($update) {
            Session::flash('success','Mengedit Data Milik PPE '.$request->title);
            return redirect()->route('ppe');
        }else{
            Session::flash('error','Gagal Mengedit Data Milik PPE '.$request->title);
            return redirect()->route('ppe');
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
        $data = BidangFileModels::find($id);
        $destroy = $data->delete();

        Activity::add([
            'page' => 'Menghapus Data Milik PPE',
            'description' => 'Menghapus Data Milik PPE '.$request->title
        ]);

        if ($destroy) {
            Session::flash('success','Menghapus Data Milik PPE '.$request->title);
            return redirect()->route('ppe');
        }else{
            Session::flash('error','Gagal Menghapus Data Milik PPE '.$request->title);
            return redirect()->route('ppe');
        }
    }
}
