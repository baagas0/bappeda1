<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

routeController('/', 'FrontEndController');
routeController('/ajax-front', 'AjaxFrontend');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

route::group(['middleware' => ['auth:moffice']], function(){
    routecontroller('/moffice', 'Moffice\MofficeController');
    routecontroller('/moffice/proses', 'Moffice\MofficeProses');
});

Route::get('/moffice/landing', 'Moffice\MofficeController@landing')->name('moffice.landing');

route::group(['prefix' => 'moffice'], function() {
	Route::get('login', 'Moffice\LoginController@showLoginForm')->name('moffice.login');
	Route::post('login', 'Moffice\LoginController@login')->name('moffice.proses.login');
	Route::post('logout', 'Moffice\LoginController@logout')->name('moffice.logout');
});


route::group(['prefix' => 'pemuda',], function(){
    
    // php artisan command
    routecontroller('command', 'Admin\Artisan');
    
    // Profile Route
    routeController('profile', 'Admin\Profile');
    route::get('/', 'IndexController@pemuda')->middleware('auth')->name('dashboard');

    route::group(['middleware' => ['role:superadmin']], function(){
        //Dashboard Route
        routeController('users', 'Admin\UsersController');
        routeController('gradasi', 'Admin\Gradasi');
        routeController('space-room', 'Admin\SpaceRoom');
    });

    route::group(['middleware' => ['role:admin|superadmin']], function(){
        // Admin Route Management
        routeController('menu', 'Admin\Menu');
        routeController('dokumen', 'Admin\Dokumen');
        routeController('structure', 'Admin\Structure');
        routeController('page', 'Admin\Page');
        routeController('run-text', 'Admin\RunningText');
        routeController('banner', 'Admin\Banner');
        routeController('slider', 'Admin\Slider');
        routeController('link', 'Admin\Link');
        routeController('applikasi', 'Admin\Applikasi');
        routeController('album', 'Admin\Gallery');
        routeController('picture', 'Admin\PictureName');
        routeController('youtube', 'Admin\Youtube');
        routeController('upload-material', 'Admin\UploadMaterial');
        routeController('foreword', 'Admin\Foreword');
        routeController('news', 'Admin\News');
        routeController('guest-book', 'Admin\GuestBook');
        routeController('category', 'Admin\Category');
        routeController('post', 'Admin\Post');
        routeController('announcement', 'Admin\Announcement');
        routeController('settings', 'Admin\Settingss');

        // Medsos Route Management
        routeController('instagram', 'Admin\Ig');
        Route::get('/instagram/up/{id}', 'Admin\Ig@Updateactive')->name('instagram.up');
        Route::get('/instagram/sync', function() {
            Artisan::call('ig:feed');
            return view('admin.instagram.main');
        })->name('instagram.sync');
    });
    
    route::group(['middleware' => ['role:bidang|superadmin']], function(){
        routeController('berita', 'Admin\Berita');
    });

    route::group(['middleware' => ['role:bidang|superadmin']], function(){
        // Bidang Route Management
        routeController('bidang-manage', 'Admin\BidangController');
        routeController('kegiatan', 'Admin\KegiatanController');
        routeController('absensi', 'Admin\AbsensiController');
        routeController('suggestion', 'Admin\SuggestionController');
        
        
        
        routeController('bpsb', 'Admin\Bpsb');
        routeController('ekonomi', 'Admin\Ekonomi');
        routeController('infrastruktur', 'Admin\Infrastruktur');
        routeController('ppe', 'Admin\Ppe');
        routeController('litbang', 'Admin\Litbang');
    });
});

    