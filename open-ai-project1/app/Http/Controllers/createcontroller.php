<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\utilisateur;
use Illuminate\Support\Facades\Hash;

class createcontroller extends Controller
{
    public function index(){
        return view('admin.create-user');
    }
    public function store(request $request){
        
        $Formfeilds= $request->validate([
            'name'=>'required|min:3',
            'email'=>'required|email',
            'password'=>'required|min:9|max:15|confirmed',
        ]);
        $Formfeilds['password']=Hash::make($request->password);
        utilisateur::create($Formfeilds);

        return redirect()->route('liste')->with('success' , 'user is well created');
    }
}
