<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokumen as ModelsDokumen;
use DB;
use Auth;
use Session;
use App\Helpers\Activity;

class Page extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['data'] = DB::table('dokumen')
                        ->join('users','users.id','=','dokumen.iduser')
                        ->join('menu','menu.id','=','dokumen.menu_id')
                        ->select('dokumen.id','dokumen.title','dokumen.tmin','users.name','menu.title as judul')
                        ->paginate(10);
        $data['title'] = 'Menu';
        return view('admin.page.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = 'Tambah Halaman';
        // $data['auth'] = Auth();
        return view('admin.page.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        $page = new ModelsDokumen;
        $page->menu_id = $request->menu_id;
        $page->title = $request->title;
        $page->content = $request->content;
        $page->iduser = Auth()->user()->id;
        $save = $page->save();

        if ($save) {
            toastr()->success('Data Menu : '.$request->title.' Berhasil Di Simpan');
            return redirect()->route('page');
        }else{
            toastr()->erorr('Data Menu : '.$request->title.' Gagal Di Simpan');
            return redirect()->route('page');
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
        $data['data'] = ModelsDokumen::find($id);
        // dd($data['data']);
        $data['title'] = 'Edit Halaman';
        return view('admin.page.form', $data);
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
        $page = ModelsDokumen::find($id);
        $page->menu_id = $request->menu_id;
        $page->title = $request->title;
        $page->content = $request->content;
        $page->iduser = Auth()->user()->id;
        $save = $page->save();

        if ($save) {
            toastr()->success('Data Menu : '.$request->title.' Berhasil Di Edit');
            return redirect()->route('page');
        }else{
            toastr()->erorr('Data Menu : '.$request->title.' Gagal Di Edit');
            return redirect()->route('page');
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
        $page = ModelsDokumen::find($id);
        $destroy = $page->delete();

        if ($destroy) {
            toastr()->success('Data Page : '.$page->title.' Berhasil Di Hapus');
            return redirect()->route('page');
        }else{
            toastr()->erorr('Data Page : '.$page->title.' Gagal Di Hapus');
            return redirect()->route('page');
        }
    }
}
