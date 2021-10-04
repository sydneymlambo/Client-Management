@extends('layouts.app')
@section('body-id', 'dashboard')
@section('content')
    <?php $init_amount = $company->initial_payment_balance; $paid_amount = 0; ?>
    @if(auth()->user()->user_role < 3 || auth()->user()->email == $company->clients->client_email)
    <div class="flex flex-wrap justify-center mt-5">
        <div class="w-full p-5 mx-auto bg-white flex flex-wrap">
            <div class="w-6/12 mb-5">
                <strong>Company reference number:</strong> <br>
                {{ $company->company_reference }}
            </div>

            <div class="w-6/12 mb-5">
                <strong>Company registration number:</strong> <br>
                {{ $company->company_registration_number }}
            </div>

            <div class="w-6/12 mb-5">
                <strong>Company owner:</strong> <br>
                {{ $company->clients->client_name }}
            </div>

            <div class="w-6/12 mb-5">
                <strong>Company renewal date:</strong> <br>
                {{ $company->company_renewal }}
            </div>

            <div class="w-6/12 mb-5">
                <strong>Company details capture on:</strong> <br>
                {{ $company->created_at }}
            </div>

            <div class="w-6/12 mb-5">
                <strong>Company details modified at:</strong> <br>
                {{ $company->updated_at }}
            </div>
        </div>

        <div class="w-full p-5">
            <h4 class="mb-4">Add Company Branch</h4>
            <form action="{{ url('/companies/branch') }}" method="post" class="mb-4 flex flex-wrap ">
                @csrf
                <div class="mb-4 w-6/12 px-2 input-field">
                    <select name="company_id" id="company_id" class="@error('company_id') border-red-500 @enderror" value="{{ old('company_id') }} disabled" required>
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    </select>
                    <label for="company_id">Company Name</label>
                    @error('company_id')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2 input-field">
                    <input type="text" name="contact" id="contact" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('contact') border-red-500 @enderror" value="{{ old('contact') }}" required>
                    <label for="contact">Contact Number</label>
                    @error('contact')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-full px-2 input-field">
                    <input type="text" name="address" id="address" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('address') border-red-500 @enderror" value="{{ old('address') }}" required>
                    <label for="address">Address</label>
                    @error('address')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2 input-field">
                    <input type="text" name="city" id="city" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('city') border-red-500 @enderror" value="{{ old('city') }}" required>
                    <label for="city">City</label>
                    @error('city')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2 input-field">
                    <input type="text" name="postal_code" id="postal_code" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('postal_code') border-red-500 @enderror" value="{{ old('postal_code') }}" required>
                    <label for="postal_code">Postal Code</label>
                    @error('postal_code')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mt-5 w-8/12 mx-auto">
                    <button type="submit" class="btn btn-primary btn-block">Add Branch</button>
                </div>
            </form>
        </div>

        <div class="w-full p-5 mx-auto">

            <div class="w-full p-5 bg-primary-fade rounded flex flex-wrap">
                <div class="w-full mb-5">
                    <h2>Branches</h2>
                    <table class="w-full bg-white">
                        <tr class="text-left">
                            <th class="p-3 border border-red-800">Contact Number</th>
                            <th class="p-3 border border-red-800">Address</th>
                            <th class="p-3 border border-red-800">City</th>
                            <th class="p-3 border border-red-800">Postal Code</th>
                            <th>Action</th>
                        </tr>
                            @foreach($company->branches as $branch)
                                <tr>
                                    <td class="p-3 border border-red-800">{{ $branch->contact }}</td>
                                    <td class="p-3 border border-red-800">{{ $branch->address }}</td>
                                    <td class="p-3 border border-red-800">{{ $branch->city }}</td>
                                    <td class="p-3 border border-red-800">{{ $branch->postal_code }}</td>
                                    <td class="p-3 border border-red-800">
                                        <form action="{{ route('branches.destroy', $branch) }}" method="post">
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

        <div class="w-full p-5 mx-auto">

            <div class="w-full p-5 bg-primary-fade rounded flex flex-wrap">
                <div class="w-full mb-5">
                    <h2>Payments</h2>
                    <table class="w-full bg-white">
                        <tr class="text-left">
                            <th class="p-3 border border-red-800">Invoice number</th>
                            <th class="p-3 border border-red-800">Payment for</th>
                            <th class="p-3 border border-red-800">Payment amount</th>
                            <th class="p-3 border border-red-800">Payment date</th>
                            <th class="p-3 border border-red-800">Total amount paid</th>
                            <th class="p-3 border border-red-800">Total amount outstanding</th>
                            <th class="p-3 border border-red-800">Action</th>
                        </tr>
                        @foreach($company->payments as $payment)
                            <?php
                            $init_amount = $init_amount - $payment->payment_amount;
                            $paid_amount = $paid_amount + $payment->payment_amount;
                            ?>
                            <tr>
                                <td class="p-3 border border-red-800">{{ $payment->invoice_number }}</td>
                                <td class="p-3 border border-red-800">{{ $payment->payment_for }}</td>
                                <td class="p-3 border border-red-800">{{ $payment->payment_amount }}</td>
                                <td class="p-3 border border-red-800">{{ $payment->payment_date }}</td>
                                <td class="p-3 border border-red-800">{{ $paid_amount }}</td>
                                <td class="p-3 border border-red-800">{{ $init_amount }}</td>
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
    </div>
    @else
    <p>You do not have access to this page</p>
    @endif
@endsection
