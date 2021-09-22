<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Service;
use App\Models\Company;

use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function index() {
        $companies = Company::with('invoices')->get();
        $invoices = Invoice::with('companies')->get();
        return view('invoices.create', [
            'companies' => $companies,
            'invoices' => $invoices,
        ]);
    }

    public function store(Request $request) {
        //Validate
        $this->validate($request, [
            'company_id' => 'required|max:255',
            'billing_address' => 'required|max:255',
        ]);

        //Store
        Invoice::create([
            'quotation_number' => $request->quotation_number,
            'invoice_number' => $request->invoice_number,
            'company_id' => $request->company_id,
            'billing_address' => $request->billing_address,
        ]);

        return redirect()->route('invoices');
    }

    public function show(Invoice $invoice) {
        $current_date = date_create(date('Y-m-d'));
        $title = $invoice->invoice_number;
        return view('invoices.view', [
            'invoice' => $invoice,
        ]);
    }

    public function storeService(Request $request) {
        //Validate
        $this->validate($request, [
            'invoice_id' => 'required|max:255',
            'service_name' => 'required|max:255',
            'service_quantity' => 'required|max:255',
            'service_price' => 'required|max:255',
        ]);

        //Store
        Service::create([
            'invoice_id' => $request->invoice_id,
            'service_name' => $request->service_name,
            'service_quantity' => $request->service_quantity,
            'service_price' => $request->service_price,
        ]);

        return redirect()->back();
    }
}
