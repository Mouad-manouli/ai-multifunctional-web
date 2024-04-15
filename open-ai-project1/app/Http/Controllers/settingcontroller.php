<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class settingcontroller extends Controller
{
    public function index(){
        return view('users.setting');
    }

    public function key(Request $request){
        $key = $request->input('key');

        $request->validate([
            'key' => 'required|starts_with:sk-'
        ], [
            'key.starts_with' => 'Your openai key is incorrect.'
        ]);

        Session::put('key', $key);
        if(isset($key)){
            return to_route('setting')->with('success' ,'the openai API is registered');
        }
        else{
            return to_route('setting');
        }
    }
}
