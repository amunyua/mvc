<?php

namespace App\Http\Controllers;

use App\Skin;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ThemeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('system.theme_config');
    }

    public function saveSkin(Request $request){
        $user = Auth::user();
//        var_dump($user);exit;
        $skin_count = Skin::all()->count();
        if($skin_count){
            // update skin
            Skin::whereNotNull('id')
                ->update([
                'theme' => $request->theme,
                'done_by' => $user->masterfile_id
            ]);
            return Response::json(['success' => true]);
        }else {
            // add skin
            $skin = new Skin();
            $skin->theme = $request->theme;
            $skin->done_by = $user->masterfile_id;
            $skin->save();
            return Response::json(['success' => true]);
        }
    }

    public function getTheme(){
        $skin = Skin::whereNotNull('id')->first();
        return Response::json($skin);
    }
}
