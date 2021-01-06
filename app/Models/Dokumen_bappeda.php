<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen_bappeda extends Model
{
    public function kategori(){
        return $this->hasMany('App\Models\Kategori_dokumen');
    }
}
