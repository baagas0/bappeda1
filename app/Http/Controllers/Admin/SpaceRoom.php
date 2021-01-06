<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu as ModelsMenu;
use App\Helpers\Activity;

class SpaceRoom extends Controller
{
    public function getIndex()
    {
        $data['data'] = ModelsMenu::where('parent_id','=','0')
            ->orderby('menu_order','asc')->get();
        $data['title'] = 'Menu';
        return view('admin.menu.main', $data);
    }
}
