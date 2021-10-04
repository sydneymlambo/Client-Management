@extends('layouts.app')
@section('body-id', 'create-invoice')
@section('content')
    @if(auth()->user()->user_role < 3)
        <div class="w-full flex justify-center mt-10">
            <div class="w-full p-5 mx-auto bg-white rounded">
                <form action="{{ route('invoices') }}" method="post" class="mb-4 flex flex-wrap ">
                    @csrf
                    <div class="mb-4 w-6/12 px-2 input-field">
                        <select name="company_id" id="company_id" class="@error('company_id') border-red-500 @enderror" value="{{ old('company_id') }}" required>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                            @endforeach
                        </select>
                        <label for="company_id">Customer</label>
                        @error('company_id')
                        <div class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-4 w-6/12 px-2 input-field">
                        <input type="number" name="invoice_number" id="invoice_number" class="@error('invoice_number') border-red-500 @enderror" value="{{ old('invoice_number') }}">
                        <label for="invoice_number">Invoice Number</label>
                    </div>
                    <div class="mb-4 w-6/12 px-2 input-field">
                        <input type="number" name="quotation_number" id="quotation_number" class="@error('quotation_number') border-red-500 @enderror" value="{{ old('quotation_number') }}">
                        <label for="quotation_number">Quotation Number</label>
                    </div>
                    <div class="mb-4 w-6/12 px-2 input-field">
                        <input type="text" name="billing_address" id="billing_address" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('billing_address') border-red-500 @enderror" value="{{ old('billing_address') }}" required>
                        <label for="billing_address">Billing Address</label>
                        @error('billing_address')
                        <div class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mt-5 w-8/12 mx-auto">
                        <button type="submit" class="btn btn-primary btn-block">Create</button>
                    </div>
                </form>
                <div class="w-full mt-5">
                    <div class="search">
                        <input id="search" type="text" class="form-control"  placeholder="Search for Invoice......">
                    </div>
                </div>

                <div class="w-full mt-4">
                    <table class="striped">
                        <thead>
                        <tr class="border-bottom-1 text-left">
                            <th>Invoice Number or Quotation Number</th>
                            <th>Invoice For</th>
                            <th>Billing Address</th>
                        </tr>
                        </thead>
                        <tbody id="table">
                        @foreach($invoices as $invoice)
                            <tr>
                                <td><a href="{{ route('invoices.invoice', $invoice->id ) }}">@if(!empty($invoice->invoice_number)){{ $invoice->invoice_number }}@elseif(!empty($invoice->quotation_number)){{ $invoice->quotation_number }}@endif</a></td>
                                <td><a href="{{ route('invoices.invoice', $invoice->id ) }}">{{ $invoice->companies->company_name }}</a></td>
                                <td>{{ $invoice->billing_address }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <p>You don't have access to this page</p>
    @endif
@endsection