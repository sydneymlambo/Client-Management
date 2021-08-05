<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {

        return view('auth.login');
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

        return redirect()->route('dashboard');
    }
}
