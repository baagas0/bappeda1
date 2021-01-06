<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    public function user(){
    	return $this->belongsTo('App\Models\Users');
    }
    
    public function bidang(){
        return $this->belongsTo('App\Models\Bidang');
    }
}
