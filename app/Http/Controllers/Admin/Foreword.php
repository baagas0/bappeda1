<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prakata as PrakataModels;
use Session;
use App\Helpers\Activity;

class Foreword extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data['data'] = PrakataModels::get();
        $data['title'] = 'Menu';
        return view('admin.module.foreword.main', $data);
    }
    public function getEdit($id)
    {
        $data['data'] = PrakataModels::find($id);
        // dd($data['data']);
        $data['title'] = 'Edit Halaman';
        return view('admin.module.foreword.form', $data);
    }
    public function postUpdate(Request $request, $id)
    {
        $data = PrakataModels::find($id);
        $data->prakata = $request->prakata;
        $save = $data->update();

        if ($save) {
            toastr()->success('Data Prakata Berhasil Di Edit');
            return redirect()->route('prakata');
        }else{
            toastr()->erorr('Data Prakata Gagal Di Edit');
            return redirect()->route('prakata');
        }
    }
}
