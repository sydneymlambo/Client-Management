<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Company;

class PaymentsController extends Controller
{
    public function index() {
        $companies = Company::with('payments')->get();
        $payments = Payment::with('companies')->paginate(20);
        return view('payments', [
            'payments' => $payments,
            'companies' => $companies,
        ]);
    }
    
    public function store(Request $request) {
        //Validate
        $this->validate($request, [
            'company_id' => 'required|max:255',
            'invoice_number' => 'required|max:255',
            'payment_for' => 'required|max:255',
            'payment_amount' => 'required|max:11',
            'payment_date' => 'required|max:255',
        ]);

        //Store
        Payment::create([
            'company_id' => $request->company_id,
            'invoice_number' => $request->invoice_number,
            'payment_for' => $request->payment_for,
            'payment_amount' => $request->payment_amount,
            'payment_date' => $request->payment_date,
        ]);

        return redirect()->route('payments');
    }

    public function destroy(Payment $payment) {
        $payment->delete();

        return back();
    }
}
