<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    public function registration(){
        return view('auth/registration');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:App\Models\User',
            'password' => 'required|min:6',
        ]);

        $user = User::Create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);

        $user->createToken('myAppToken');
        return redirect()->route('login');
    }

    public function login(){
        return view('auth/signin');
    }

    public function getLogin(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password' => 'required|min:6'
        ]);

        $credinentals = [
            'email' => request('email'),
            'password' => request('password')
        ];

        if(Auth::attempt($credinentals)){
            $request->session()->regenerate();
            return redirect('/');
        }
        return back()->withErrors([
            'email' => 'The provided credinentals do not match our records.'
        ]);
    }

    public function logOut(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
