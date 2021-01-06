<?php

namespace App\Http\Controllers\Admin;

use Intervention\Image\Facades\Image as Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Helpers\ApiData;
use App\Models\Igfeed;
use Storage;
use Session;
use Artisan;
use App\Helpers\Activity;

class Ig extends Controller
{
    public function getIndex()
    {
        $data['data'] = Igfeed::where('source', 'like' ,'%instagram%')->orderBy('id_ig', 'DESC')->get();
        $data['last_sync'] = Igfeed::orderBy('created_at', 'desc')->limit(1)->first();
        // dd($data['data']);
        return view('admin.instagram.main', $data); 
    }

    public function getAdd()
    {
        $data['title'] = 'Tambah Data';
        return view('admin.instagram.form', $data);
    }

    public function postAdd(Request $request)
    {
        $id = Igfeed::orderBy('id_ig', 'asc')->first();
        $id_ig = $id->id_ig + 1;
        // dd($id_ig);

        $add = new Igfeed;
        $add->id_ig = $id_ig;
        $add->caption = $request->caption;
        
        $files = $request->files;

        foreach ($files as $fil) {
            // dd($file);
            foreach ($fil as $file) {
                $file_name = 'instagram - '.time().$file->getClientOriginalName();
                $path = '/frontend/images/instagram/'.$file_name;
                $file->move(public_path().$path);
                $file_name1[] = $path;
            }
        }
        $add->file = json_encode($file_name1);
        $add->type = '';
        $add->save();

        return redirect('pemuda/instagram');                 
    }

    public function getEdit($id)
    {
        $data['title'] = 'Tambah Data';
        $data['data'] = Igfeed::findOrFail($id);
        return view('admin.instagram.form', $data);
    }

    public function postEdit(Request $Request, $id)
    {
        $update = Igfeed::findOrFail($id);

        return view('admin.instagram.form', $data);
    }

    public function getDestroy($id)
    {
        $data = Igfeed::findOrfail($id);
        $data->delete();

        Activity::add([
            'page' => 'Menghapus Data',
            'description' => 'Menghapus Data : ' . $data->name
        ]);

        return redirect('pemuda/instagram'); 
    }

    public function getSyncig()
    {
	   	$response = Artisan::call('ig:feeds');
         
        $data['data'] = 'Data sync'; 
        return $response; 
   	}

    public function Updateactive($id)
    {
        $id = Igfeed::findOrFail($id);
        if ($status == 1) {
            $id->active = 0;
        }else{
            $id->active = 1;
        }
        $id->save();
        return $id;
    }
}
