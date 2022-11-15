<?php

namespace App\Http\Controllers;

use App\Mail\LupaPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class LupaPasswordController extends Controller
{
    public function index(){
        return view('auth.lupa-password');
    }
    
    public function submit(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(64);
        
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        $email = $request->email;
        Mail::to($request->email)->send(new LupaPassword($token, $email));

        return back()->with('message', 'Kami Telah Mengirim Password Reset Link Ke Email!');
    }

    public function showResetPassword($email, $token){
        return view('auth.reset-password', [
            'email' => $email,
            'token' => $token
        ]);
    }

    public function ResetPassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'

        ]);
        $updatePassword = DB::table('password_resets')
                            ->where([
                              'email' => $request->email, 
                              'token' => $request->token
                            ])
                            ->first();
        if(!$updatePassword){
        return back()->withInput()->with('error', 'Invalid token!');

        }

        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email'=> $request->email])->delete();
        return redirect('/login')->with('message', 'Your password has been changed!');
    }
}
