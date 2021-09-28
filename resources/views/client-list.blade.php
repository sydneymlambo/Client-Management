@extends('layouts.app')
@section('body-id', 'clients')
@section('content')
    <div class="flex justify-center mt-5">
        <div class="w-full p-5 mx-auto bg-white rounded">
            <div class="add-button py-4">
                <a href="#register-client" class="modal-btn waves-effect waves-light btn"><i class="icon icon-edit" style="background-image: url({{ asset('img/plus.png') }});"></i> Register a Client</a><a class="ml-5 btn btn-primary print-btn">Print</a>
            </div>
            <div class="search">
                <input id="search" type="text" class="form-control"  placeholder="Search for record......">
            </div>
            @if($clients->count())
                <div class="p-5 mt-3">
                    <table class="striped">
                        <thead>
                        <tr class="border-bottom-1 text-left">
                            <th class="">Client Name</th>
                            <th class="">Client Surname</th>
                            <th class="">Client ID Number</th>
                            <th class="">Client Email</th>
                            <th class="">Client Cellphone Number</th>
                            <th>Client Type</th>
                            <th class="">Client Company</th>
                        </tr>
                        </thead>
                        <tbody id="table">
                        @foreach($clients as $client)
                            <tr>
                                <td class="">{{ $client->client_name }}</td>
                                <td class="">{{ $client->client_surname }}</td>
                                <td class="">{{ $client->client_id_number }}</td>
                                <td class="">{{ $client->client_email }}</td>
                                <td class="">{{ $client->client_cellphone }}</td>
                                <td>{{ $client->client_type }}</td>
                                <td class="">@foreach($client->companies as $company) @if($client->id == $company->client_id)
                                        <a href="{{ route('companies') }}#{{ $company->id }}">{{ $company->company_name }}</a>
                                    <br> @else no company @endif @endforeach</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                no clients
            @endif
        </div>
    </div>

    <div class="flex justify-center register-modal hide modal">
        <div class="overlay"></div>
        <div class="w-10/12 p-5 mx-auto bg-white rounded register-form">
            <div class="pb-4 text-right">
                <button class="close"><i class="icon icon-close" style="background-image: url({{ asset('img/close.png') }})"></i></button>
            </div>
            <form action="{{ route('clients') }}" method="post" class="mb-4 flex flex-wrap ">
                @csrf
                <div class="mb-4 w-6/12 px-2 input-field">
                    <input type="text" name="client_name" id="client_name" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('client_name') border-red-500 @enderror" value="{{ old('client_name') }}">
                    <label for="client_name">Client Name</label>
                    @error('client_name')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2 input-field">
                    <input type="text" name="client_surname" id="client_surname" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('client_surname') border-red-500 @enderror" value="{{ old('client_surname') }}">
                    <label for="client_surname">Client Surname</label>
                    @error('client_surname')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2 input-field">
                    <input type="text" name="client_id_number" id="client_id_number" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('client_id_number') border-red-500 @enderror" value="{{ old('client_id_number') }}">
                    <label for="client_id_number">Client ID Number</label>
                    @error('client_id_number')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2 input-field">
                    <input type="text" name="client_cellphone" id="client_cellphone" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('client_cellphone') border-red-500 @enderror" value="{{ old('client_cellphone') }}">
                    <label for="client_cellphone">Client Cellphone Number</label>
                    @error('client_cellphone')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-5 w-6/12 px-2 input-field">
                    <input type="text" name="client_email" id="client_email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('client_email') border-red-500 @enderror" value="{{ old('client_email') }}">
                    <label for="client_email">Client Email</label>
                    @error('client_email')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2 input-field">
                    <select name="client_type" id="client_type" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('client_type') border-red-500 @enderror" value="not specified" required>
                        <option selected value="not specified">Not specified</option>
                        <option value="Membership Client">Membership Client</option>
                        <option value="Cash Client">Cash Client</option>
                    </select>
                    <label for="client_type">Client Type</label>
                    @error('client_type')
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
