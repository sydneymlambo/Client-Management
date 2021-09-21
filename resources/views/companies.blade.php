@extends('layouts.app')
@section('body-id', 'companies')
@section('content')
    <div class="flex justify-center mt-5">
        <div class="w-full p-5 mx-auto bg-white rounded">
            <div class="add-button py-4">
                <a href="#register-client" class="modal-btn waves-effect waves-light btn"><i class="icon icon-edit" style="background-image: url({{ asset('img/plus.png') }});"></i> Register a Company</a>
            </div>
            <div class="search">
                <input id="search" type="text" class="form-control"  placeholder="Search for record......">
            </div>
            @if($companies->count())
                <div class="rounded p-5 mt-3">
                    <table class="striped">
                        <thead>
                        <tr class="border-bottom-1 text-left">
                            <th class="">Company Name</th>
                            <th class="">Company Owner</th>
                            <th class="">Company Reference</th>
                            <th class="">Company Registration Number</th>
                            <th class="">Company Renewal</th>
                            <th class="">Days left for Renewal</th>
                            <th class="">Outstanding payment</th>
                            <th class="" colspan="2"> Actions</th>
                        </tr>
                        </thead>
                        <tbody id="table">
                        @foreach($companies as $company)
                            <?php
                            $dateDiff = date_diff($current_date, date_create($company->company_renewal));
                            $days = str_replace("+", "",$dateDiff->format("%R%a"));
                            ?>
                            <x-company :company="$company" :days="$days" :dateDiff="$dateDiff" :payments="$payments" />
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{--<div class="text-center">--}}
                    {{--{{ $companies->links() }}--}}
                {{--</div>--}}
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
                <div class="mb-4 w-6/12 px-2 input-field">
                    <input type="text" name="company_name" id="company_name" class="@error('company_name') border-red-500 @enderror" value="{{ old('company_name') }}" required>
                    <label for="company_name">Company Name</label>
                    @error('company_name')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2 input-field">
                    <input type="text" name="company_reference" id="company_reference" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('company_reference') border-red-500 @enderror" value="{{ old('company_reference') }}" required>
                    <label for="company_reference">Company Reference</label>
                    @error('company_reference')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-full px-2 input-field">
                    <input type="text" name="company_registration_number" id="company_registration_number" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('company_registration_number') border-red-500 @enderror" value="{{ old('company_registration_number') }}" required>
                    <label for="company_registration_number">Company Registration</label>
                    @error('company_registration_number')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2 input-field">
                    <select name="client_id" id="client_id" class="@error('client_id') border-red-500 @enderror" value="{{ old('client_id') }}" required>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                        @endforeach
                    </select>
                    <label for="client_id">Company Owner</label>
                    @error('client_id')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-5 w-6/12 px-2 input-field">
                    <input type="date" name="company_renewal" id="company_renewal" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('company_renewal') border-red-500 @enderror" value="{{ old('company_renewal') }}" required>
                    <label for="company_renewal">Company Renewal (yyyymmdd)</label>
                    @error('company_renewal')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 w-6/12 px-2 input-field">

                    <input type="text" name="initial_payment_balance" id="initial_payment_balance" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('initial_payment_balance') border-red-500 @enderror" value="{{ old('initial_payment_balance') }}" required>
                    <label for="initial_payment_balance">Payment due</label>
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
