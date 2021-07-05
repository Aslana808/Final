<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function register(RegisterRequest $request){
        User::create([
            'name' => $request->get('name'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);

        //sign in
        auth()->attempt($request->only('email', 'password'));
        return redirect()->route('dashboard');
    }
}
