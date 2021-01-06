<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model  
{
    protected $guarded = array();
    
    protected $table = "dokumen";

    public static $rules = array(
        'menu_id' => 'required',
        'title' => 'required',
        'content' => 'required',
        'iduser' => 'required',
    );

    public static function all($columns = array('*')){
        $instance = new static;
        if (\PermissionsLibrary::hasPermission('mod-halaman-listall')){
            return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
        }else{
            return $instance->newQuery()
            ->where('role_id', \Session::get('role_id'))
            ->paginate($_ENV['configurations']['list-limit']);  
            
        }
    }
    
    public static function namaMenu($id){
        $menu = \DB::table('menu')
                ->where('id','=',$id)
                ->first();
        return $menu->title;
    }
}
