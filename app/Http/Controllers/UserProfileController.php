<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index() {
        $title = 'Profile';
        return view('user.profile', [
            'title' => $title,
        ]);
    }

    public function view() {
        $users = User::paginate(20);
        $title = "Users";
        return view('user.users', [
            'users' => $users,
            'title' => $title,
        ]);
    }

    public function edit($id) {
        $user = User::where('id', $id)->first();
        $title = 'Update User';
        return view('edit-user', [
            'user' => $user,
            'title' => $title,
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

        return redirect()->back();
    }

    public function destroy(User $user) {
        $user->delete();

        return back();
    }
}
