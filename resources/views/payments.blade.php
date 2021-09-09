@extends('layouts.app')
@section('body-id', 'dashboard')
@section('content')
    <div class="flex flex-wrap justify-center mt-5">
        <div class="heading w-full p-5 mx-auto">
            <h1>Payments</h1>
        </div>
        <div class="w-full p-5 mx-auto bg-white">
            <div class="mb-5">
                <a href="#register-client" class="modal-btn waves-effect waves-light btn"><i class="icon icon-edit" style="background-image: url({{ asset('img/plus.png') }});"></i> Capture payment</a>
            </div>
            <div class="search">
                <input id="search" type="text" class="form-control"  placeholder="Search for record......">
            </div>
            @if($payments->count())
                @if(auth()->user()->user_role == 1)
                    <div class="p-5">
                <table class="w-full striped">
                    <thead>
                        <tr class="text-left">
                            <th class="">Invoice number</th>
                            <th class="">Payment by</th>
                            <th class="">Payment for</th>
                            <th class="">Payment amount</th>
                            <th class="">Payment date</th>
                            <th class=""> Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table">
                        @foreach($payments as $payment)
                            <tr>
                                <td class="">{{ $payment->invoice_number }}</td>
                                <td class="">{{ $payment->companies->company_name }}</td>
                                <td class="">{{ $payment->payment_for }}</td>
                                <td class="">{{ $payment->payment_amount }}</td>
                                <td class="">{{ $payment->payment_date }}</td>
                                <td class="">
                                    <form action="{{ route('payments.destroy', $payment) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete"> <i class="icon icon-delete" style="background-image: url({{ asset('img/bin.png') }})"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                @else
                    <p class="text-red-800 text-bold">You currently do not have permissions to view these records</p>
                @endif
            @else
                <p class="text-red-800 text-bold">No Payments</p>
            @endif
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

                <div class="mb-4 w-6/12 px-2 input-field">
                    <input type="number" name="invoice_number" id="invoice_number" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('invoice_number') border-red-500 @enderror" value="{{ old('invoice_number') }}" required>
                    <label for="invoice_number">Invoice number</label>
                    @error('invoice_number')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 w-6/12 px-2 input-field">
                    <select name="company_id" id="company_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('company_id') border-red-500 @enderror" value="{{ old('company_id') }}" required>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                    <label for="company_id">Payment made by</label>
                    @error('company_id')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 w-6/12 px-2 input-field">
                    <input type="text" name="payment_for" id="payment_for" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('payment_for') border-red-500 @enderror" value="{{ old('payment_for') }}" required>
                    <label for="payment_for">Payment for</label>
                    @error('payment_for')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2 input-field">
                    <input type="number" name="payment_amount" id="payment_amount" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('payment_amount') border-red-500 @enderror" value="{{ old('payment_amount') }}" required>
                    <label for="payment_amount">Payment amount</label>
                    @error('payment_amount')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2 input-field">
                    <input type="date" name="payment_date" id="payment_date" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('payment_date') border-red-500 @enderror" value="{{ old('payment_date') }}" required>
                    <label for="payment_date">Payment date</label>
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
