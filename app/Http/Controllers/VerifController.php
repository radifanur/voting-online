<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class VerifController extends Controller
{
    public function index()
    {  
        $cek = Auth::user()->name;
        if (empty($cek)){
            return view('auth.verif');
        }
        else {
            return redirect()->route('verif.token');
        }
        
    }


    public function verif(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $user = Auth::user()->id;

        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $string = '';

        for($x=0; $x<6; $x++){
            $y = rand(0, strlen($karakter)-1);
            $string .= $karakter[$y];
        };

        $token = strtoupper($string);
        $cek = User::find($token);

        if (empty($cek)){
            User::whereId($user)->update([
                'name' => $request->name,
                'token' => $token,
            ]);

            $data = [
                'token' => $token,
                'nama' => $request->name
            ];


            Mail::to(Auth::user()->email)->send(new Email($data));

            return redirect()->route('verif.token');

            
        };
    }

    public function verifToken()
    {
        $nama = Auth::user()->name;
        $email = Auth::user()->email;
        $cek = User::where('name', '=', $nama)
                ->where('email', '=', $email);    
        if (!empty($cek)) {
            return view('auth.veriftoken');
        }
        
    }

    public function kirimUlang()
    {
        $user = Auth::user()->id;

        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $string = '';

        for($x=0; $x<6; $x++){
            $y = rand(0, strlen($karakter)-1);
            $string .= $karakter[$y];
        };

        $token = strtoupper($string);
        $cek = User::find($token);
        if (empty($cek)){
            User::whereId($user)->update([
                'token' => $token,
            ]);

            $data = [
                'token' => $token,
                'nama' => Auth::user()->name
            ];


            Mail::to(Auth::user()->email)->send(new Email($data));

            return redirect()->route('verif.token');
   
        } 
    }

    public function verified(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        $token = $request->token;
        $data = User::where('token', $token)->first();

        if (!empty($data)) {
            $user = Auth::user()->id;

            User::whereId($user)->update([
                'verif' => 1,
            ]);

            return redirect()->route('dashboard')
            ->with('success', 'User Berhasil Verifikasi!');
        } else {
            return redirect()->route('verif.token')
            ->with('error', 'Token Tidak Valid!');
        }

        
    }

}
