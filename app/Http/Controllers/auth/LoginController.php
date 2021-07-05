<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function login(LoginRequest $request){
        //remember creates remember token which saves our session, it will not get garbage collected
        // it will also add that remember token to the database
        if (auth()->attempt($request->only('email', 'password'), $request->remember)){
            return redirect()->route('dashboard');
        }
        else {
            return redirect()->back()->with('status', 'Invalid credentials! please try again');
        }
    }
}
