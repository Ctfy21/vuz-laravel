<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function registration(){
        return view('auth/registration');
    }

    public function createAccount(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        return response()->json($request);
    }
}
