<?php

namespace App\Http\Controllers;

use App\Models\Client;

use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index() {
        $title = "Clients";
        $clients = Client::with('companies')->get();
        return view('client-list', [
            'clients' => $clients,
            'title' => $title,
        ]);
    }

    public function store(Request $request) {
        //Validate
        $this->validate($request, [
            'client_name' => 'required|max:255',
            'client_surname' => 'required|max:255',
            'client_id_number' => 'required|max:13',
            'client_email' => 'email|max:255',
            'client_cellphone' => 'required|max:12',
            'client_type' => 'required|max:255',
        ]);

        //Store
        Clien::create([
            'client_name' => $request->client_name,
            'client_surname' => $request->client_surname,
            'client_id_number' => $request->client_id_number,
            'client_email' => $request->client_email,
            'client_cellphone' => $request->client_cellphone,
            'client_type' => $request->client_type,
        ]);

        return redirect()->route('clients');
    }
}
