<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BidangFile as BidangFileModels;
use Auth;
use Session;
use App\Helpers\Activity;

class Infrastruktur extends Controller
{
    public function getIndex()
    {
        $data['title'] = 'Infrastruktur';

        $data['data'] = BidangFileModels::where('bidang_id', 3)->get();
        return view('admin.bidang.infrastruktur.main', $data);
    }

    public function getAdd()
    {
        $data['title'] = 'Tambah Infrastruktur';
        return view('admin.bidang.infrastruktur.form', $data);
    }

    public function postStore(Request $request)
    {
        $data = new BidangFileModels;
        $data->bidang_id = 3;
        $data->title = $request->title;
        $data->description = $request->description;

        $file = $request->file('file');

        $file_name = 'bidang'.time().$file->getClientOriginalName();
        $path = '/backend/assets/images/bidang/3/';
        $file->move(public_path().$path, $file_name);
        $data->file = $path.$file_name; 

        $save = $data->save();

        Activity::add([
            'page' => 'Menambah Data Baru Milik Infrastruktur',
            'description' => 'Menambah Data Baru Milik Infrastruktur '.$request->title
        ]);

        if ($save) {
            Session::flash('success','Menambah Data Baru Milik Infrastruktur '.$request->title);
            return redirect()->route('infrastruktur');
        }else{
            Session::flash('error','Gagal Menambah Data Baru Milik Infrastruktur '.$request->title);
            return redirect()->route('infrastruktur');
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
        return view('admin.bidang.infrastruktur.form', $data);

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
        $path = '/backend/assets/images/bidang/3/';
        $file->move(public_path().$path, $file_name);
        $data->file = $path.$file_name; 
	    }

        $update = $data->save();

        Activity::add([
            'page' => 'Mengedit Data Milik Infrastruktur',
            'description' => 'Mengedit Data Milik Infrastruktur '.$request->title
        ]);

        if ($update) {
            Session::flash('success','Mengedit Data Milik Infrastruktur '.$request->title);
            return redirect()->route('infrastruktur');
        }else{
            Session::flash('error','Gagal Mengedit Data Milik Infrastruktur '.$request->title);
            return redirect()->route('infrastruktur');
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
            'page' => 'Menghapus Data Milik Infrastruktur',
            'description' => 'Menghapus Data Milik Infrastruktur '.$request->title
        ]);

        if ($destroy) {
            Session::flash('success','Menghapus Data Milik Infrastruktur '.$request->title);
            return redirect()->route('infrastruktur');
        }else{
            Session::flash('error','Gagal Menghapus Data Milik Infrastruktur '.$request->title);
            return redirect()->route('infrastruktur');
        }
    }
}
