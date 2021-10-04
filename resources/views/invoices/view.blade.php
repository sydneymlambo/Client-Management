@extends('layouts.app')
@section('body-id', 'view-invoice')
@section('content')
    @if(auth()->user()->user_role < 3)
<div class="flex flex-wrap justify-center mt-5">
    <div class="w-full p-5 mx-auto bg-white flex flex-wrap">
        <div class="py-5">
            <a class="btn btn-primary" href="{{ route('invoices') }}">Back</a>
        </div>
        <form action="{{ url('/invoices/storeservice') }}" method="post" class="mb-4 w-full flex flex-wrap ">
            @csrf
            <div class="mb-4 w-6/12 px-2 input-field hidden">
                <input type="number" name="invoice_id" id="invoice_id" class="hidden" required readonly value="{{ $invoice->id }}">
                <label for="invoice_number">Invoice Number</label>
            </div>
            <div class="mb-4 w-full px-2 input-field">
                <input type="text" name="service_name" id="service_name" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('service_name') border-red-500 @enderror" value="{{ old('service_name') }}" required>
                <label for="service_name">Item</label>
                @error('service_name')
                <div class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-4 w-1/2 px-2 input-field">
                <input type="text" name="service_quantity" id="service_quantity" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('service_quantity') border-red-500 @enderror" value="{{ old('service_quantity') }}" required>
                <label for="service_quantity">Quantity</label>
                @error('service_quantity')
                <div class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-4 w-1/2 px-2 input-field">
                <input type="number" name="service_price" id="service_price" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('service_price') border-red-500 @enderror" value="{{ old('service_price') }}" required>
                <label for="service_price">Price</label>
                @error('service_price')
                <div class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mt-5 w-1/2 mx-auto pr-2">
                <button type="submit" class="btn btn-primary btn-block">Add Item</button>
            </div>
            <div class="mt-5 w-1/2 mx-auto pl-2">
                <a class="btn btn-primary btn-block print-btn">Print</a>
            </div>
        </form>
    </div>
    <div id="invoice" class="w-full p-5 mx-auto bg-white flex flex-wrap">
        <div class="w-full">
            <img class="content-logo" src="{{ asset('img/logo.png') }}" alt="" width="300" height="auto">
        </div>
        <div class="w-6/12 mb-5">
            <div class="mb-5">
                @if(!empty($invoice->invoice_number))
                    <strong>Invoice number</strong> <br>
                    {{ $invoice->invoice_number }}
                @elseif(!empty($invoice->quotation_number))
                    <strong>Quotation number</strong> <br>
                    {{ $invoice->quotation_number }}
                @endif
            </div>
            <div class="mb-5">
                <strong>Customer</strong> <br>
                {{ $invoice->companies->company_name }}
            </div>
        </div>
        <div class="w-6/12 mb-5">
            <div class="mb-5">
                <strong>Billing Address:</strong> <br>
                {{ $invoice->billing_address }}
            </div>
            <div class="mb-5">
                <strong>Billing Address:</strong> <br>
                {{ $invoice->created_at }}
            </div>
        </div>

        <div class="w-full">
            <table>
                <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php $total = 0; $items = 0; ?>
                @foreach($invoice->services as $service)
                    <tr>
                        <td>{{ $service->service_name }}</td>
                        <td>{{ $service->service_quantity }}</td>
                        <td>{{ $service->service_price }}</td>
                        <td>{{ $service->service_price * $service->service_quantity }}</td>
                    </tr>
                    <?php $item = $service->service_price * $service->service_quantity; $total = $total + $item ?>
                @endforeach
                <?php $incl_vat = $total * 0.15 ?>
                <tr>
                    <td colspan="3"><strong style="font-weight: 700">VAT(15%)</strong></td>
                    <td><strong style="font-weight: 700">{{ $total * 0.15 }}</strong></td>
                </tr>
                <tr>
                    <td colspan="3"><strong style="font-weight: 700">Total excl VAT</strong></td>
                    <td><strong style="font-weight: 700">{{ $total }}</strong></td>
                </tr>
                <tr>
                    <td colspan="3"><strong style="font-weight: 700">Total incl VAT</strong></td>
                    <td><strong style="font-weight: 700">{{ $incl_vat + $total }}</strong></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
    @else
        <p>You don't have access to this page</p>
    @endif
@endsection