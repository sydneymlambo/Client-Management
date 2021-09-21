<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Client;
use App\Models\Reminder;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() {

        $companies = Company::with('clients')->get();
        $clients = Client::with('companies')->get();
        $current_date = date_create(date('Y-m-d'));
        $users = User::with('reminders')->get();
        $reminders = Reminder::with('users')->get();

        $title = 'Dashboard';

        return view('dashboard', [
            'companies' => $companies,
            'clients' => $clients,
            'current_date' => $current_date,
            'users' => $users,
            'reminders' => $reminders,
            'title' => $title,
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'user_id' => 'required|max:11',
            'subject' => 'required|max:255',
            'note' => 'required|max:255',
            'email' => 'required|max:255',
            'reminder_date' => 'required|max:255',
            'reminder_type' => 'max:255',
        ]);

        Reminder::create([
            'user_id' => $request->user_id,
            'subject' => $request->subject,
            'note' => $request->note,
            'email' => $request->email,
            'reminder_date' => $request->reminder_date,
            'reminder_type' => $request->reminder_type,
        ]);

        return redirect()->route('dashboard');
    }

    public function destroy(Reminder $reminder) {
        $reminder->delete();

        return back();
    }
}
