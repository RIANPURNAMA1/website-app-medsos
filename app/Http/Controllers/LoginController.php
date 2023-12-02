<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
     public function login(){
        return view('login.login');
     }

     public function loginStore(Request $request){
        $validasi = $request->validate([
         'email'=>'required|email',
         'password'=>'required'
        ]);

        if(Auth::attempt($validasi)){
            $request->session()->regenerate();
           return redirect()->intended('/');

        }
        return back()->with('error', 'Email dan password salah');
     }

     public function logout(Request $request){
     Auth::logout();
     $request->session()->invalidate();
     $request->session()->regenerateToken();

     return redirect('/login');
     }
}
