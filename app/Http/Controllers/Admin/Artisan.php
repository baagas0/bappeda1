<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artisan as Command;
use Route as Routeas;
use Illuminate\Routing\Route;

class Artisan extends Controller
{
    public function getCommand($id) {
        if($id == 'routes') {
        $route = Routeas::getRoutes();
        dd($route);
        }else {
        $response = Command::call($id);
        return $response;        
        }
    }
}
