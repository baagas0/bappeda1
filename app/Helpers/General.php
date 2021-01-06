<?php

use App\Models\Menu;
use App\Models\Igfeed;
use App\Models\Setting;
use App\Models\Announcement as Announcements;


if (!function_exists('routeController')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function routeController($prefix, $controller)
    {
    	$name = str_replace("/",".",$prefix);
    	$prefix = trim($prefix, '/').'/';

    	if(substr($controller,0,1) != "\\") {
    		$controller = "\App\Http\Controllers\\".$controller;
    	}

    	$exp = explode("\\", $controller);
    	$controller_name = end($exp);

    	try {
    		Route::get($prefix, ['uses' => $controller.'@getIndex', 'as' => $name]);

    		$controller_class = new \ReflectionClass($controller);
    		$controller_methods = $controller_class->getMethods(\ReflectionMethod::IS_PUBLIC);
    		$wildcards = '/{one?}/{two?}/{three?}/{four?}/{five?}';
    		foreach ($controller_methods as $method) {

    			if ($method->class != 'Illuminate\Routing\Controller' && $method->name != 'getIndex') {
    				if (substr($method->name, 0, 3) == 'get') {
    					$method_name = substr($method->name, 3);
    					$slug = array_filter(preg_split('/(?=[A-Z])/', $method_name));
    					$as = $name.'.'.strtolower(implode('.', $slug));
    					$slug = strtolower(implode('-', $slug));
    					$slug = ($slug == 'index') ? '' : $slug;
    					Route::get($prefix.$slug.$wildcards, ['uses' => $controller.'@'.$method->name, 'as' => $as]);
    				} elseif (substr($method->name, 0, 4) == 'post') {
    					$method_name = substr($method->name, 4);
    					$slug = array_filter(preg_split('/(?=[A-Z])/', $method_name));
    					$as = $name.'.'.strtolower(implode('.', $slug));
    					$slug = strtolower(implode('-', $slug));
    					Route::post($prefix.$slug.$wildcards, [
    						'uses' => $controller.'@'.$method->name,
    						'as' => $as,
    					]);
    				}
    			}
    		}
    	} catch (\Exception $e) {

    	}
    }
}

if (!function_exists('announcement')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function announcement()
    {
        $response = Announcements::first();

        return $response;
    }
}

if (!function_exists('setting')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function setting($slug)
    {
        $find = Setting::where('slug', $slug)->first();
        return $find->value;
    }
}

if (!function_exists('menu')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function menu($slug)
    {
        $find = Menu::where('parent_id', '0')->orderBy('menu_order', 'ASC')->get();
        return $find;
    }
}

if (!function_exists('set')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function set($slug)
    {
        $find = Setting::where('slug', $slug)->first();
        return $find;
    }
}

if (!function_exists('color')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function color()
    {
        $collection = collect(['120078', '9d0191', 'fd3a69', 'fecd1a', '7579e7', 'd789d7', '81b214', 'ed6663', 'fe91ca', '3ca59d']);

        $shuffled = $collection->shuffle();
        
        return $shuffled->first();
    }
}