<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori_dokumen;
use App\Models\Dokumen_bappeda;
use Auth;
use Session;
use App\Helpers\Activity;
use DataTables;

class Dokumen extends Controller
{
    public function getKategoriDokumen()
    {
    	$data['data'] = Kategori_dokumen::get();
        return view('admin.dokumen.main', $data);
    }

    public function postInputKategoriDokumen(Request $request)
    {
        $is_text = $request->has('is_text');
        // dd($is_text);
    	$row = Kategori_dokumen::insert([
    		'name' => $request->name,
    		'judul' => $request->judul,
    		'uraian' => $request->uraian,
            'is_text' => $is_text,
            'text' => $request->document,
    	]);

        if ($row) {
            Session::flash('success','Menambah Data Kategori Baru '.$request->name);
            return redirect()->route('dokumen.kategori.dokumen');
        }else{
            Session::flash('error','Gagal Menambah Data Kategori Baru '.$request->name);
            return redirect()->route('dokumen.kategori.dokumen');
        }
    }

    public function getEditKategoriDokumen($id)
    {
        $data['data'] = Kategori_dokumen::get();
        $data['update'] = Kategori_dokumen::findOrFail($id);
        return view('admin.dokumen.main', $data);
    }

    public function postUpdateKategoriDokumen(Request $request, $id){
        // dd($is_text);
        $row = Kategori_dokumen::findOrFail($id);
        $row->name = $request->name;
        $row->judul = $request->judul;
        $row->uraian = $request->uraian;
        $is_text = $request->has('is_text');
        $row->is_text = $is_text;
        $row->text = $request->document;
        $row->save();

        if ($row) {
            Session::flash('success','Mengedit Data Kategori Baru '.$request->name);
            return redirect()->route('dokumen.kategori.dokumen');
        }else{
            Session::flash('error','Gagal Mengedit Data Kategori Baru '.$request->name);
            return redirect()->route('dokumen.kategori.dokumen');
        }
    }

    public function getDeleteKategoriDokumen($id){
        $data = Kategori_dokumen::find($id);
        $destroy = $data->delete();

        if ($destroy) {
            Session::flash('success','Data Kategori Dokumen : '.$data->judul.' Berhasil Di Hapus');
            return redirect()->route('dokumen.kategori.dokumen');
        }else{
            Session::flash('error','Data Kategori Dokumen : '.$data->judul.' Gagal Di Hapus');
            return redirect()->route('dokumen.kategori.dokumen');
        }
    }

// ====================================================================================
// ====================================================================================
// ====================================================================================

    public function getUploadDokumen(Request $request)
    {
    	if ($request->ajax()) {

            $data = Dokumen_bappeda::select('*');

            return Datatables::of($data)

                    ->filter(function ($instance) use ($request) {

                        if ($request->get('kategori_dokumen_id') == '0' || $request->get('kategori_dokumen_id') == '1') {

                            $instance->where('kategori_dokumen_id', $request->get('kategori_dokumen_id'));

                        }

                        if (!empty($request->get('search'))) {

                             $instance->where(function($w) use($request){

                                $search = $request->get('search');

                                $w->orWhere('kategori_dokumen_id', 'LIKE', "%".$search."%");

                            });

                        }

                    })

                    ->rawColumns(['kategori_dokumen_id'])

                    ->make(true);

        }
        $data['full'] = Dokumen_bappeda::get();
        return view('admin.dokumen.upload', $data);
    }
    public function postFilterTable(Request $request){
    	if ($request->kategori_id == 0) {
	    	$data['data'] = Dokumen_bappeda::get();
    	}else {
	    	$data['data'] = Dokumen_bappeda::where('kategori_dokumen_id', $request->kategori_id)->get();
	    }

    	return view('admin.dokumen.table_kategori',$data);
    }
    public function postStore(Request $request){
        // dd($request->periode);
        $row = new Dokumen_bappeda;
        $row->kategori_dokumen_id = $request->kategori_dokumen_id;
        $thumbnail  = $request->file('thumbnail');
        $file       = $request->file('file');
        // dd($request->keterangan);

        if ($thumbnail) {
            $thumbnail_name = 'thumbnail'.time().$thumbnail->getClientOriginalName();
            $path_thumb = '/backend/assets/images/dokumen-bappeda/thumbnail/';
            $thumbnail->move(public_path().$path_thumb, $thumbnail_name); 
            $row->thumbnail = $path_thumb.$thumbnail_name;
        }
        if ($file) {
            $file_name = 'dokumen'.time().$file->getClientOriginalName();
            $path_file = '/backend/assets/images/dokumen-bappeda/dokumen/';
            $file->move(public_path().$path_file, $file_name); 
            $row->file = $path_file.$file_name;
        }
        $row->periode = $request->periode;
        $row->perubahan = $request->perubahan;
        $row->judul = $request->judul;
        $row->keterangan = $request->keterangan;
        $save = $row->save();
        if ($save) {
            Session::flash('success','Menambah Data Dokumen Baru '.$request->judul);
            return redirect()->route('dokumen.upload.dokumen');
        }else{
            Session::flash('error','Gagal Menambah Data Dokumen Baru '.$request->judul);
            return redirect()->route('dokumen.upload.dokumen');
        }
    }

    public function postUpdate(Request $request, $id){

        // dd($request->periode);
        $row = Dokumen_bappeda::findOrFail($id);
        $row->kategori_dokumen_id = $request->kategori_dokumen_id;
        $thumbnail  = $request->file('thumbnail');
        $file       = $request->file('file');
        // dd($request->keterangan);

        if ($thumbnail) {
            $thumbnail_name = 'thumbnail'.time().$thumbnail->getClientOriginalName();
            $path_thumb = '/backend/assets/images/dokumen-bappeda/thumbnail/';
            $thumbnail->move(public_path().$path_thumb, $thumbnail_name); 
            $row->thumbnail = $path_thumb.$thumbnail_name;
        }
        if ($file) {
            $file_name = 'dokumen'.time().$file->getClientOriginalName();
            $path_file = '/backend/assets/images/dokumen-bappeda/dokumen/';
            $file->move(public_path().$path_file, $file_name); 
            $row->file = $path_file.$file_name;
        }
        $row->periode = $request->periode; 
        $row->perubahan = $request->perubahan;
        $row->judul = $request->judul;
        $row->keterangan = $request->keterangan;
        $save = $row->save();
        if ($save) {
            Session::flash('success','Mengedit Data Dokumen Baru '.$request->judul);
            return redirect()->route('dokumen.upload.dokumen');
        }else{
            Session::flash('error','Gagal Mengedit Data Dokumen Baru '.$request->judul);
            return redirect()->route('dokumen.upload.dokumen');
        }
    }

    public function getDelete($id){
        $data = Dokumen_bappeda::findOrFail($id);
        $destroy = $data->delete();

        if ($destroy) {
            Session::flash('success','Data Dokumen : '.$data->judul.' Berhasil Di Hapus');
            return redirect()->route('dokumen.upload.dokumen');
        }else{
            Session::flash('error','Data Dokumen : '.$data->judul.' Gagal Di Hapus');
            return redirect()->route('dokumen.upload.dokumen');
        }
    }
}

