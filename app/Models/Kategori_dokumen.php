<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori_dokumen extends Model
{
    public function dokumen(){
        return $this->hasMany('App\Models\Dokumen_bappeda');
    }
}
