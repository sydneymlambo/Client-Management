<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\CustomerRemark;

class ClientRemarksController extends Controller
{
    public function index() {
        $title = 'Customer Remarks';
        $clients = Client::get();
        $remarks = CustomerRemark::get();
        return view('client-remarks', [
            'title' => $title,
            'clients' => $clients,
            'remarks' => $remarks,
        ]);
    }
    
    public function store(Request $request) {

        $this->validate($request, [
            'client_name' => 'required|max:255',
            'remark' => 'required|min:5',
        ]);

        //Store
        CustomerRemark::create([
            'client_name' => $request->client_name,
            'subject' => $request->subject,
            'remark' => $request->remark,
        ]);

        return redirect()->route('clients-remarks');
    }

    public function destroy(CustomerRemark $cutomerRemark) {
        $cutomerRemark->delete();

        return back();
    }
}
