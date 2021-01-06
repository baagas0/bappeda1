<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita as BeritaModels;
use App\Helpers\Activity;
use Session;

class Berita extends Controller
{
    public function getIndex()
    {
        $data['data'] = BeritaModels::get();
        $data['title'] = 'Menu';
        return view('admin.berita.main', $data);
    }

    public function getAdd()
    {
        // $data['data'] = BeritaModels::get();
        $data['title'] = 'Menu';
        return view('admin.berita.form', $data);
    }

    public function postAdd(Request $request)
    {
        $add = new BeritaModels;
        $add->title = $request->title;
        $add->content = $request->content;

        $gambar = $request->file('photo');

        $gambar_name = 'berita'.time().$gambar->getClientOriginalName();
        $path = '/frontend/images/berita/';
        $gambar->move(public_path().$path,$gambar_name); 

        $add->photo = $path.$gambar_name;

        $save= $add->save();

        Activity::add([
            'page' => 'Menambah Berita',
            'description' => 'Menambah Berita '.$request->title
        ]);

        if ($save) {
            Session::flash('success','Menambah Berita '.$request->title);
            return redirect()->route('berita');
        }else{
            Session::flash('error','Gagal Menambah Berita '.$request->title);
            return redirect()->route('berita');
        }
    }

    public function getEdit($id)
    {
        $data['data'] = BeritaModels::findOrFail($id);
        $data['title'] = 'Menu';
        return view('admin.berita.form', $data);
    }

    public function postEdit(Request $request, $id)
    {
        $update = BeritaModels::findOrFail($id);
        $update->title = $request->title;
        $update->content = $request->content;

        $gambar = $request->file('photo');

        if ($gambar) {
            $gambar_name = 'berita'.time().$gambar->getClientOriginalName();
            $path = '/frontend/images/berita/';
            $gambar->move(public_path().$path,$gambar_name); 
            $update->photo = $path.$gambar_name;
        }

        $save = $update->save();

        Activity::add([
            'page' => 'Mengedit Berita',
            'description' => 'Mengedit Berita '.$request->title
        ]);

        if ($save) {
            Session::flash('success','Mengedit Berita '.$request->title);
            return redirect()->route('berita');
        }else{
            Session::flash('error','Gagal Mengedit Berita '.$request->title);
            return redirect()->route('berita');
        }
    }

    public function getDestroy($id)
    {
        $data = BeritaModels::find($id);
        $destroy = $data->delete();

        Activity::add([
            'page' => 'Menghapus Berita',
            'description' => 'Menghapus Berita '.$data->title
        ]);

        if ($destroy) {
            Session::flash('success','Menghapus Berita '.$data->title);
            return redirect()->route('berita');
        }else{
            Session::flash('error','Gagal Menghapus Berita '.$data->title);
            return redirect()->route('berita');
        }
    }
}
