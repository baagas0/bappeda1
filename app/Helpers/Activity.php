<?php

namespace App\Helpers;

use Request;
use App\UserLog;
use Carbon\Carbon;
use Auth;

class Activity
{
	public static function add($data)
	{

		$log = new UserLog;
		$log->user_id = auth()->user()->id;
		$log->page 			= $data['page'];
		$log->description 	= $data['description'];
		$log->method 		= Request::method();
		$log->url 			= Request::fullUrl();
		$log->ip 			= Request::ip();
		$log->agent 		= Request::header('user-agent');
		$log->created_at	= carbon::now();
		$log->save();
	}

	public static function manual_id($data)
	{
		$log = new UserLog;
		$log->user_id = $data['user_id'];
		$log->page 			= $data['page'];
		$log->description 	= $data['description'];
		$log->method 		= Request::method();
		$log->url 			= Request::fullUrl();
		$log->ip 			= Request::ip();
		$log->agent 		= Request::header('user-agent');
		$log->save();
	}

	public static function list()
	{
		$data = UserLog::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->limit(10)->get();

        return $data;
	}
}


