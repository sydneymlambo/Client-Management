<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        $title = "";

        return view('auth.login', [
            'title' => $title,
        ]);
    }

    public function store(Request $request) {
        //Validate
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Sign in
        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('status', 'Invalid login details');
        }
        if(auth()->user()->user_role < 3) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('companies');
        }
    }
}
