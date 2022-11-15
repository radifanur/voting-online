<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    

class LoginController extends Controller
{
    public function view(){
        return view('auth.login');
    }

    public function index()
    {
        if (Auth::check())
        {
            return redirect()->intended('/');
        };
        // if ($user = Auth::user()){
        //     if ($user->roles_id == 1){
        //         return redirect()->intended('/');
        //     } elseif ($user->roles_id == 2){
        //         return redirect()->intended('/');
        //     } elseif ($user->roles_id == 3){
        //         return redirect()->intended('/');
        //     }
        // }

        return view('auth.login');
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);



        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->roles_id == 1){
                return redirect()->intended('/');
            } elseif ($user->roles_id == 2){
                return redirect()->intended('/');
            } elseif ($user->roles_id == 3){
                return redirect()->intended('/');
            }

            return redirect()->intended('/');
        }
        return redirect()->route('login')
        ->with('errors', 'Login Gagal Silahkan Masukan Data dengan Benar!');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('login');
    }
}

