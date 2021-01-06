<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Models\Suggestion_list;
use App\Models\Kegiatan_bidang;
use App\Models\Users;
use App\Models\Bidang;
use Auth;

class SuggestionController extends Controller
{
    public function getIndex() {
        $user = Users::where('id', Auth::user()->id)->first();
        foreach($user->roles->pluck('name') as $roles){
            if($roles == 'superadmin'){
                $role = 'superadmin';
            }else {
                $role = '';
            }
        }
        if($role == 'superadmin') {
            $data['suggestion'] = Suggestion::get();
        }else {
            $bidang = Bidang::where('route', $user->username)->first();
            $data['suggestion'] = Suggestion::where('bidang_id', $bidang->id)->get();
        }
        return view('admin.suggestion.main', $data);
    }
    
    public function postAjaxSuggestion(Request $request) {
        $suggestion = Suggestion::where('id', $request->kegiatanbidang)->first();
        $data['suggestion_list'] = suggestion_list::where('suggestion_id', $request->kegiatanbidang)->get();
        $data['kegiatan_bidang'] = Kegiatan_bidang::where('id', $suggestion->kegiatan_bidang_id)->first();
        return view('admin.suggestion.ajax', $data);
    }
}
