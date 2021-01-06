<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu as ModelsMenu;
use Auth;
use Session;
use App\Helpers\Activity;

class Menu extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['data'] = ModelsMenu::where('parent_id','=','0')
            ->orderby('menu_order','asc')->get();
        $data['title'] = 'Menu';
        return view('admin.menu.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $data['title'] = 'Tambah Menu';
        return view('admin.menu.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        $data = new ModelsMenu;
        $data->title = $request->title;
        $data->parent_id = $request->parent_id;
        $data->jenurl = $request->jenurl;
        $data->target = $request->target;
        $data->url = $request->url;
        $data->menu_order = $request->menu_order;
        $data->title_small =  str_replace(" ","-",strtolower($request->title));
        $data->user_id = Auth::id();
        $save = $data->save();

        Activity::add([
            'page' => 'Menambah Menu Baru',
            'description' => 'Menambah Menu '.$request->title
        ]);

        if ($save) {
            Session::flash('success','Menambah Menu '.$request->title);
            return redirect()->route('menu');
        }else{
            Session::flash('error','Gagal Menambah Menu '.$request->title);
            return redirect()->route('menu');
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
        $data['data'] = ModelsMenu::find($id);
        // dd($data['data']);
        $data['title'] = 'Edit Halaman';
        return view('admin.menu.form', $data);
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
        $data = ModelsMenu::find($id);
        $data->title = $request->title;
        $data->parent_id = $request->parent_id;
        $data->jenurl = $request->jenurl;
        $data->target = $request->target;
        $data->url = $request->url;
        $data->menu_order = $request->menu_order;
        $data->title_small =  str_replace(" ","-",strtolower($request->title));
        $data->user_id = Auth::id();
        $save = $data->update();

        Activity::add([
            'page' => 'Mengedit Menu',
            'description' => 'Mengedit Menu '.$request->title
        ]);

        if ($save) {
            Session::flash('success','Mengedit Menu '.$data->title);
            return redirect()->route('menu');
        }else{
            Session::flash('error','Gagal Mengedit Menu '.$data->title);
            return redirect()->route('menu');
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
        $data = ModelsMenu::find($id);
        $destroy = $data->delete();

        Activity::add([
            'page' => 'menghapus Menu',
            'description' => 'menghapus Menu '.$data->title
        ]);

        if ($destroy) {
            Session::flash('success','menghapus Menu '.$data->title);
            return redirect()->route('menu');
        }else{
            Session::flash('error','Gagal menghapus Menu '.$data->title);
            return redirect()->route('menu');
        }
    }
}
