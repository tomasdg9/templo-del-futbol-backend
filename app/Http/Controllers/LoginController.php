<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){

        $credentials = [
                "email" => $request->email,
                "password" => $request->password
        ];

        $remember = ($request->has('remember') ? true : false);

        if(Auth::attempt($credentials, $remember)){
                $request->session()->regenerateToken();
                return redirect()->intended(route('principio'));
        } else {
            return redirect(route('login'))->with('error', 'Los datos ingresados no son correctos.');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
