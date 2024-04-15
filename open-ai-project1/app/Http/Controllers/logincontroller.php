<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class logincontroller extends Controller
{
    public function index(){
        Session::forget('key');
        Session::forget('conversations');
        return view('connexion.login');
    }
    public function login(request $request){
        $name =$request->name;
        $password =$request->password;
        $credentials =['name'=>$name,'password'=> $password];
       if(Auth::guard('admin')->attempt($credentials)){
            $request->session()->regenerate();
            return to_route('liste');
       }
       elseif(Auth::guard('web')->attempt($credentials)){
            $request->session()->regenerate();
            return to_route('chat');
       }
       else{
            return back()->withErrors([
                'name'=>'The name is incorrect',
                'password'=>'The password is incorrect'
            ]);
       }
    }
}
