<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\utilisateur;

class updatecontroller extends Controller
{
    public function index(utilisateur $utilisateur){
        return view('admin.update-user',compact('utilisateur'));
    }
    public function edit(request $request,utilisateur $utilisateur){
        $Formfeilds= $request->validate([
            'name'=>'required|min:3',
            'email'=>'required|email',
            'password'=>'required|min:9|max:15|confirmed',
        ]);
        $Formfeilds['password']=Hash::make($request->password);
        $utilisateur->fill($Formfeilds)->save();
        return to_route('liste')->with('success' ,'User has been updated');
    }
}
