<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index() {
        return view('user.profile');
    }

    public function view() {
        $users = User::paginate(20);

        return view('user.users', [
            'users' => $users,
        ]);
    }

    public function edit($id) {
        $user = User::where('id', $id)->first();

        return view('edit-user', [
            'user' => $user,
        ]);
    }

    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'username' => 'required|max:255',
            'user_role' => 'required',
        ]);

        User::where('id', $request->id)->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'username' => $request->username,
            'user_role' => $request->user_role,
        ]);

        return redirect()->route('users');
    }

    public function destroy(User $user) {
        $user->delete();

        return back();
    }
}
