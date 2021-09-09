<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use App\Models\Payment;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function index() {
        $companies = Company::with('clients')->get();
        $clients = Client::with('companies')->get();
        $payments = Company::with('payments')->get();
        //dd($clients->companies);
        $current_date = date_create(date('Y-m-d'));
        return view('companies', [
            'companies' => $companies,
            'clients' => $clients,
            'current_date' => $current_date,
            'payments' => $payments,
        ]);
    }

    public function show(Company $company) {
        $current_date = date_create(date('Y-m-d'));
        return view('company', [
            'company' => $company,
            'current_date' => $current_date,
        ]);
    }

    public function store(Request $request) {
        //Validate
        $this->validate($request, [
            'company_name' => 'required|max:255',
            'company_reference' => 'required|max:255',
            'company_registration_number' => 'required|max:255',
            'client_id' => 'required|max:255',
            'company_renewal' => 'required|max:255',
            'initial_payment_balance' => 'required|max:11',
        ]);

        //Store
        Company::create([
            'company_name' => $request->company_name,
            'company_reference' => $request->company_reference,
            'company_registration_number' => $request->company_registration_number,
            'client_id' => $request->client_id,
            'company_renewal' => $request->company_renewal,
            'initial_payment_balance' => $request->initial_payment_balance,
        ]);

        return redirect()->route('companies');
    }

    public function destroy(Company $company) {
        $company->delete();

        return back();
    }

    public function edit($id){
        $company = Company::where('id', $id)->first();

        return view('edit-company', [
            'company' => $company,
        ]);
    }

    public function update(Request $request) {
        $this->validate($request, [
            'company_name' => 'required|max:255',
            'company_reference' => 'required|max:255',
            'company_registration_number' => 'required|max:255',
            'company_renewal' => 'required|max:255',
            'initial_payment_balance' => 'required|max:11',
        ]);

        Company::where('id', $request->id)->update([
            'company_name' => $request->company_name,
            'company_reference' => $request->company_reference,
            'company_registration_number' => $request->company_registration_number,
            'company_renewal' => $request->company_renewal,
            'initial_payment_balance' => $request->initial_payment_balance,
        ]);

        return redirect()->route('companies');
    }
}
