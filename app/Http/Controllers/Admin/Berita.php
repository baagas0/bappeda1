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

class Berita extends Controller
{
    public function getIndex()
    {
        $data['data'] = Igfeed::where('source' ,'berita')->orderBy('id_ig', 'DESC')->get();
        $data['last_sync'] = Igfeed::orderBy('created_at', 'desc')->limit(1)->first();

        return view('admin.berita.main', $data);  
    }

    public function getAdd()
    {
        $data['title'] = 'Tambah Data';
        return view('admin.berita.form', $data);
    }

    public function postAdd(Request $request)
    {
        $id = Igfeed::orderBy('id_ig', 'asc')->first();
        $id_ig = $id->id_ig + 1;
        // dd($id_ig);

        $add = new Igfeed;
        $add->id_ig = $id_ig;
        $add->caption = $request->caption;
        
        $files = $request->file;
        // dd($request->all());
        if ($files) {
            foreach ($files as $file) {
                // foreach ($fil as $file) {
                    $file_name = 'berita - '.time().$file->getClientOriginalName();
                    $path = '/frontend/images/instagram/';
                    $file->move(public_path().$path,$file_name);
                    $file_name1[] = $path.$file_name;
                // }
            }
            $add->file = json_encode($file_name1);
        }
        $add->type = 'berita';
        $add->source = 'berita';
        $add->is_sosbud = $request->has('is_sosbud');
        $add->is_ekonomi = $request->has('is_ekonomi');
        $add->is_infrastruktur= $request->has('is_infrastruktur');
        $add->is_ppe = $request->has('is_ppe');
        $add->is_litbang = $request->has('is_litbang');
        $add->save();
    
        if ($save) {
	            Session::flash('success','Data Berita '.$request->caption.'Berhasil Di Simpan');
	            return redirect()->route('pemuda.berita');
	        }else{
	            Session::flash('error','Data Berita '.$request->caption.'Gagal Di Simpan');
	            return redirect()->route('pemuda.berita');
	        }            
    }

    public function getEdit($id)
    {
        $data['title'] = 'Tambah Data';
        $data['data'] = Igfeed::findOrFail($id);
        return view('admin.berita.form', $data);
    }

    public function postEdit(Request $request, $id)
    {
        $add = Igfeed::findOrFail($id);
        
        
        $add->caption = $request->caption;
        
        $files = $request->file;
        // dd($request->all());
        if ($files) {
            foreach ($files as $file) {
                // foreach ($fil as $file) {
                    $file_name = 'berita - '.time().$file->getClientOriginalName();
                    $path = '/frontend/images/instagram/';
                    $file->move(public_path().$path,$file_name);
                    $file_name1[] = $path.$file_name;
                // }
            }
            $add->file = json_encode($file_name1);
        }
        $add->type = 'berita';
        $add->source = 'berita';
        $add->is_sosbud = $request->has('is_sosbud');
        $add->is_ekonomi = $request->has('is_ekonomi');
        $add->is_infrastruktur= $request->has('is_infrastruktur');
        $add->is_ppe = $request->has('is_ppe');
        $add->is_litbang = $request->has('is_litbang');
        $save = $add->save();
        
        if ($save) {
	            Session::flash('success','Data Berita '.$request->caption.'Berhasil Di Simpan');
	            return redirect()->route('pemuda.berita');
	        }else{
	            Session::flash('error','Data Berita '.$request->caption.'Gagal Di Simpan');
	            return redirect()->route('pemuda.berita');
	        }    
    }

    public function getDestroy($id)
    {
        $data = Igfeed::findOrfail($id);
        $data->delete();

        Activity::add([
            'page' => 'Menghapus Data',
            'description' => 'Menghapus Data : ' . $data->name
        ]);

        return redirect('pemuda/berita'); 
    }

    public function getSyncig()
    {
        Artisan::call('ig:feeds');
        
        $response['data'][] = 'Daya sync';
        return json_encode($response);
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
