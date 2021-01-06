<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use DataTables;
use Session;
use App\Helpers\Activity;

class Settingss extends Controller
{
	public function getIndex(Request $request)
	{
		$data['title'] = "Data Settings";
		$data['data'] = Setting::get();

		return view('admin.settings.index', $data);
	}

	public function getAdd()
	{
		$data['title'] = "Data Settings";

		return view('admin.settings.form', $data);
	}

	public function postAdd(Request $request)
	{
		$request->validate([
			'slug' => 'required|min:2|max:255|unique:settings',
			'name' => 'required|min:2|max:255',
			'value' => 'required'
		]);

		$data = new Setting;
		$data->slug = $request->slug;
		$data->name = $request->name;
		$data->value = $request->value;
		$save = $data->save();

		Activity::add([
            'page' => 'Menambah Pengaturan Baru',
            'description' => 'Menambah Pengaturan Baru '.$request->slug
        ]);

        if ($save) {
            Session::flash('success','Menambah Pengaturan Baru '.$request->slug);
            return redirect()->route('settings');
        }else{
            Session::flash('error','Gagal Menambah Pengaturan Baru '.$request->slug);
            return redirect()->route('settings');
        }
	}

	public function getEdit($id)
	{
		$data['title'] = "Edit Settings";
		$data['data'] = Setting::findOrFail($id);

		return view('admin.settings.form', $data);
	}

	public function postEdit($id, Request $request)
	{
		$request->validate([
			'slug' => 'required|min:2|max:255|unique:settings',
			'name' => 'required|min:2|max:255',
			'value' => 'required'
		]);

		$data = Setting::findOrFail($id);
		$data->slug = $request->slug;
		$data->name = $request->name;
		$data->value = $request->value;
		$save = $data->update();

		Activity::add([
            'page' => 'Mengedit Pengaturan',
            'description' => 'Mengedit Pengaturan '.$request->slug
        ]);

        if ($save) {
            Session::flash('success','Mengedit Pengaturan '.$request->slug);
            return redirect()->route('settings');
        }else{
            Session::flash('error','Gagal Mengedit Pengaturan '.$request->slug);
            return redirect()->route('settings');
        }
	}

	public function getDestroy($id)
	{
		$data = Setting::findOrFail($id);
		$data->delete();

		Session::flash('success','Menghapus Pengaturan '.$data->slug);
        return redirect()->route('settings');
	}
}
