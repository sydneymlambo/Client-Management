@extends('layouts.app')
@section('body-id', 'companies')
@section('content')
    <div class="flex justify-center mt-5">
        <div class="w-10/12 p-5 mx-auto bg-white rounded">
            <div class="add-button py-4">
                <a href="#register-client" class="modal-btn btn btn-primary"><i class="icon icon-edit" style="background-image: url({{ asset('img/plus.png') }});"></i> Register a Company</a>
            </div>
            @if($companies->count())
                <table class="table-auto w-full border border-red-800">
                    <thead>
                    <tr class="border-bottom-1">
                        <th>Company Name</th>
                        <th>Company Owner</th>
                        <th>Company Reference</th>
                        <th>Company Registration Number</th>
                        <th>Company Renewal</th>
                        <th>Days left for Renewal</th>
                        <th>Outstanding payment</th>
                        <th colspan="2"> Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($companies as $company)
                        <?php
                        $dateDiff = date_diff($current_date, date_create($company->company_renewal));
                        $days = str_replace("+", "",$dateDiff->format("%R%a"));
                        ?>
                        <x-company :company="$company" :days="$days" :dateDiff="$dateDiff" :payments="$payments" />
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $companies->links() }}
                </div>
            @else
                No Companies
            @endif
        </div>
    </div>

    <div class="flex justify-center register-modal hide modal">
        <div class="overlay"></div>
        <div class="w-10/12 p-5 mx-auto bg-white rounded register-form">
            <div class="pb-4 text-right">
                <button class="close"><i class="icon icon-close" style="background-image: url({{ asset('img/close.png') }})"></i></button>
            </div>
            <form action="{{ route('companies') }}" method="post" class="mb-4 flex flex-wrap ">
                @csrf
                <div class="mb-4 w-6/12 px-2">
                    <label for="company_name">Company Name</label>
                    <input type="text" name="company_name" id="company_name" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('company_name') border-red-500 @enderror" value="{{ old('company_name') }}" required>
                    @error('company_name')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2">
                    <label for="company_reference">Company Reference</label>
                    <input type="text" name="company_reference" id="company_reference" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('company_reference') border-red-500 @enderror" value="{{ old('company_reference') }}" required>
                    @error('company_reference')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-full px-2">
                    <label for="company_registration_number">Company Registration</label>
                    <input type="text" name="company_registration_number" id="company_registration_number" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('company_registration_number') border-red-500 @enderror" value="{{ old('company_registration_number') }}" required>
                    @error('company_registration_number')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2">
                    <label for="client_id">Company Owner</label>
                    <select name="client_id" id="client_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('client_id') border-red-500 @enderror" value="{{ old('client_id') }}" required>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                        @endforeach
                    </select>
                    @error('client_id')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-5 w-6/12 px-2">
                    <label for="company_renewal">Company Renewal (yyyymmdd)</label>
                    <input type="date" name="company_renewal" id="company_renewal" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('company_renewal') border-red-500 @enderror" value="{{ old('company_renewal') }}" required>
                    @error('company_renewal')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 w-6/12 px-2">
                    <label for="initial_payment_balance">Payment due</label>
                    <input type="text" name="initial_payment_balance" id="initial_payment_balance" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('initial_payment_balance') border-red-500 @enderror" value="{{ old('initial_payment_balance') }}" required>
                    @error('initial_payment_balance')
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