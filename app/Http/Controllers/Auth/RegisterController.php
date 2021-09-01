<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        //Validate
        $this->validate($request, [
            'user_role' => 'required|max:2',
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'username' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8|confirmed',
        ]);

        //Store
        User::create([
            'user_role' => $request->user_role,
            'name' => $request->name,
            'surname' => $request->surname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //Sign in
        auth()->attempt($request->only('email', 'password'));

        //Redirect
        return redirect()->route('dashboard');
    }
}
