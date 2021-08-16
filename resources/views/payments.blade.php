@extends('layouts.app')
@section('body-id', 'dashboard')
@section('content')
    <div class="flex flex-wrap justify-center mt-5">
        <div class="heading w-10/12 p-5 mx-auto">
            <h1>Payments</h1>
        </div>
        <div class="w-10/12 p-5 mx-auto bg-white">
            <div class="mb-5">
                <a href="#register-client" class="modal-btn btn btn-primary"><i class="icon icon-edit" style="background-image: url({{ asset('img/plus.png') }});"></i> Capture payment</a>
            </div>
            <div class="rounded bg-primary-fade p-5">
                <table class="w-full">
                    <tr class="text-left">
                        <th class="p-3 border border-red-800">Invoice number</th>
                        <th class="p-3 border border-red-800">Payment by</th>
                        <th class="p-3 border border-red-800">Payment for</th>
                        <th class="p-3 border border-red-800">Payment amount</th>
                        <th class="p-3 border border-red-800">Payment date</th>
                        <th class="p-3 border border-red-800"> Actions</th>
                    </tr>
                    @foreach($payments as $payment)
                        <tr>
                            <td class="p-3 border border-red-800">{{ $payment->invoice_number }}</td>
                            <td class="p-3 border border-red-800">{{ $payment->companies->company_name }}</td>
                            <td class="p-3 border border-red-800">{{ $payment->payment_for }}</td>
                            <td class="p-3 border border-red-800">{{ $payment->payment_amount }}</td>
                            <td class="p-3 border border-red-800">{{ $payment->payment_date }}</td>
                            <td class="p-3 border border-red-800">
                                <form action="{{ route('payments.destroy', $payment) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete"> <i class="icon icon-delete" style="background-image: url({{ asset('img/bin.png') }})"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="flex justify-center register-modal hide modal">
        <div class="overlay"></div>
        <div class="w-10/12 p-5 mx-auto bg-white rounded register-form">
            <div class="pb-4 text-right">
                <button class="close"><i class="icon icon-close" style="background-image: url({{ asset('img/close.png') }})"></i></button>
            </div>
            <form action="{{ route('payments') }}" method="post" class="mb-4 flex flex-wrap ">
                @csrf

                <div class="mb-4 w-6/12 px-2">
                    <label for="invoice_number">Invoice number</label>
                    <input type="number" name="invoice_number" id="invoice_number" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('invoice_number') border-red-500 @enderror" value="{{ old('invoice_number') }}" required>
                    @error('invoice_number')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 w-6/12 px-2">
                    <label for="company_id">Payment made by</label>
                    <select name="company_id" id="company_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('company_id') border-red-500 @enderror" value="{{ old('company_id') }}" required>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                    @error('company_id')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 w-6/12 px-2">
                    <label for="payment_for">Payment for</label>
                    <input type="text" name="payment_for" id="payment_for" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('payment_for') border-red-500 @enderror" value="{{ old('payment_for') }}" required>
                    @error('payment_for')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2">
                    <label for="payment_amount">Payment amount</label>
                    <input type="number" name="payment_amount" id="payment_amount" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('payment_amount') border-red-500 @enderror" value="{{ old('payment_amount') }}" required>
                    @error('payment_amount')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2">
                    <label for="payment_date">Payment date</label>
                    <input type="date" name="payment_date" id="payment_date" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('payment_date') border-red-500 @enderror" value="{{ old('payment_date') }}" required>
                    @error('payment_date')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mt-5 w-8/12 mx-auto">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection
