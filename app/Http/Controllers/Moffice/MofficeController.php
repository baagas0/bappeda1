<?php

namespace App\Http\Controllers\Moffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Structure as StructureModels;


class MofficeController extends Controller
{
    public function getIndex() {
        return view('moffice.index');
    }
    
    public function getSuratAll() {
        return view('moffice.surat.all');
    }
    
    public function getRapat() {
        return view('moffice.rapat.index');
    }
    
    public function getZoom() {
        return view('moffice.zoom.index');
    }
    public function getDataBarang() {
        return view('moffice.zoom.barang');
    }
    
    public function getUsers() {
        $data['data']= StructureModels::get();
        return view('moffice.user', $data);
    }
    public function getDataRuang() {
        return view('moffice.rapat.ruang');
    }
	public function landing() {
        return view('moffice.landing');
    }
    
    
    
    
}
