<?php
namespace App\Helpers;
use Ixudra\Curl\Facades\Curl;
use App\Models\Igfeed;
use App\Helpers\ApiData;
use Storage;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class ApiData
{	
	// Instagram Api
	public static function ig($data= []){
		$response = Curl::to('https://instagram40.p.rapidapi.com/account-medias?userid=7720252592&first=80')
			->withHeader('x-rapidapi-host: instagram40.p.rapidapi.com')
			->withHeader('x-rapidapi-key: 3e1ea98a56msha94cc6a7cd85d90p1659bejsne5220198818c')
            ->withTimeout()
            ->asJsonResponse()
            ->get();
        // dd($response);
        return $response;
	}
	
	// Instagram Api
	public static function instagram(){
		// 7720252592
		$response = Curl::to('https://instagram30.p.rapidapi.com/rapi/feed/7720252592')
			->withHeader('x-rapidapi-key: 3e1ea98a56msha94cc6a7cd85d90p1659bejsne5220198818c')
            ->withTimeout()
            ->asJsonResponse()
            ->get();

        dd($response);
        return $response->medias;
	}
	
	// Instagram Api 2
	public static function instagram2(){
		// 7720252592
		$response = Curl::to('https://instagram30.p.rapidapi.com/rapi/feed/7720252592')
			->withHeader('x-rapidapi-key: 3e1ea98a56msha94cc6a7cd85d90p1659bejsne5220198818c')
            ->withTimeout()
            ->asJsonResponse()
            ->get();

        dd($response);
        return $response->medias;
	}
	
	// Whatsapp Api
	public static function wa($data = []){
		$response = Http::post('http://116.203.191.58/api/send_message',[
        	'phone_no'	=> $data['phone_no'],
			'key'		=> '4e3494a062310b350b93fe3326c1b3541731d4e4dbe12011',
			'message'	=> $data['message'],
        ]);

        return 'Oke';
	}

	// Facebook Api
	public static function facebook(){
		$response = Curl::to('https://facebook30.p.rapidapi.com/rapi/feed/5405128901/1')
			->withData([
				'rapidapi-key' => env('RAPIDAPI_KEY')
			])
            ->withTimeout()
            ->asJsonResponse()
            ->get();
        return $response->medias;
	}

	// Twitter Api
	public static function twitter(){
		$response = Curl::to('https://twitter30.p.rapidapi.com/rapi/feed/5405128901/1')
			->withData([
				'rapidapi-key' => env('RAPIDAPI_KEY')
			])
            ->withTimeout()
            ->asJsonResponse()
            ->get();
        return $response->medias;
	}
	
}
