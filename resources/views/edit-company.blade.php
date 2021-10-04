@extends('layouts.app')
@section('body-id', 'dashboard')
@section('content')
    @if(auth()->user()->user_role < 3)
        <div class="flex flex-wrap justify-center mt-5">
            <div class="w-10/12 p-5 mx-auto bg-white rounded register-form">
                <form action="{{ url('/update') }}" method="post" class="mb-4 flex flex-wrap ">
                    @csrf
                    <div class="mb-4 w-6/12 px-2">
                        <label for="company_name">Company Name</label>
                        <input type="text" name="company_name" id="company_name" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('company_name') border-red-500 @enderror" value="{{ $company->company_name }}" required>
                        @error('company_name')
                        <div class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-4 w-6/12 px-2">
                        <label for="company_reference">Company Reference</label>
                        <input type="text" name="company_reference" id="company_reference" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('company_reference') border-red-500 @enderror" value="{{ $company->company_reference }}" required>
                        @error('company_reference')
                        <div class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-4 w-full px-2">
                        <label for="company_registration_number">Company Registration</label>
                        <input type="text" name="company_registration_number" id="company_registration_number" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('company_registration_number') border-red-500 @enderror" value="{{ $company->company_registration_number }}" required>
                        @error('company_registration_number')
                        <div class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-5 w-6/12 px-2">
                        <label for="company_renewal">Company Renewal (yyyymmdd)</label>
                        <input type="date" name="company_renewal" id="company_renewal" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('company_renewal') border-red-500 @enderror" value="{{ $company->company_renewal }}" required>
                        @error('company_renewal')
                        <div class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4 w-6/12 px-2">
                        <label for="initial_payment_balance">Payment due</label>
                        <input type="text" name="initial_payment_balance" id="initial_payment_balance" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('initial_payment_balance') border-red-500 @enderror" value="{{ $company->initial_payment_balance }}" required>
                        @error('initial_payment_balance')
                        <div class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-4 w-6/12 px-2 invisible">
                        <input type="text" name="id" id="id" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('id') border-red-500 @enderror" value="{{ $company->id }}" required>
                        @error('id')
                        <div class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mt-5 w-8/12 mx-auto">
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <p>You don't have access to this page</p>
    @endif
@endsection