<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement as Announcements;
use Session;
use App\Helpers\Activity;

class Announcement extends Controller
{
    public function getIndex()
    {
    	$data['title'] = 'Announcement';
    	$data['data'] = Announcements::where('is_active', 1)->get();
    	return view('admin.announcement.main', $data);
    }

    public function getAdd()
    {
        $data['title'] = 'Tambah Data';
        return view('admin.announcement.form', $data);
    }

    public function postAdd(Request $request)
    {
        
        $add = new Announcements;
        $add->content = $request->content;
        $add->title = $request->title;
        
        $file = $request->file;
            $file_name = 'pengumuman - '.time().$file->getClientOriginalName();
            $path = '/frontend/images/pengumuman/';
            $file->move(public_path().$path,$file_name);

        $add->file = $path.$file_name;
        $add->save();

        return redirect('pemuda/instagram');                 
    }

    public function getEdit($id)
    {
        $data['title'] = 'Tambah Data';
        $data['data'] = Announcements::findOrFail($id);
        return view('admin.announcement.form', $data);
    }

    public function postEdit(Request $request, $id)
    {
        $update = Announcements::findOrFail($id);
        $update->content = $request->content;
        $update->title = $request->title;
        
        $file = $request->file;

        	if ($file) {
            $file_name = 'pengumuman - '.time().$file->getClientOriginalName();
            $path = '/frontend/images/pengumuman/';
            $file->move(public_path().$path,$file_name);
	        $update->file = $path.$file_name;
        	}

        $update->save();
        return redirect('pemuda/announcement');
    }

    public function getDestroy($id)
    {
        $data = Announcements::findOrfail($id);
        $data->delete();

        Activity::add([
            'page' => 'Menghapus Data',
            'description' => 'Menghapus Data : ' . $data->title
        ]);

        return redirect('pemuda/announcement'); 
    }
}
