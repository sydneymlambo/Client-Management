@extends('layouts.app')
@section('body-id', 'clients')
@section('content')
    <div class="flex justify-center mt-5">
        <div class="w-10/12 p-5 mx-auto bg-white rounded">
            <div class="add-button py-4">
                <a href="#register-client" class="modal-btn btn btn-primary"><i class="icon icon-edit" style="background-image: url({{ asset('img/plus.png') }});"></i> Register a Client</a>
            </div>
            @if($clients->count())
                <div class="rounded bg-primary-fade p-5 mt-3">
                    <table class="table-auto w-full border border-red-800">
                        <thead>
                        <tr class="border-bottom-1 text-left">
                            <th class="p-3 border border-red-800">Client Name</th>
                            <th class="p-3 border border-red-800">Client Surname</th>
                            <th class="p-3 border border-red-800">Client ID Number</th>
                            <th class="p-3 border border-red-800">Client Email</th>
                            <th class="p-3 border border-red-800">Client Cellphone Number</th>
                            <th class="p-3 border border-red-800">Client Company</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td class="p-3 border border-red-800">{{ $client->client_name }}</td>
                                <td class="p-3 border border-red-800">{{ $client->client_surname }}</td>
                                <td class="p-3 border border-red-800">{{ $client->client_id_number }}</td>
                                <td class="p-3 border border-red-800">{{ $client->client_email }}</td>
                                <td class="p-3 border border-red-800">{{ $client->client_cellphone }}</td>
                                <td class="p-3 border border-red-800">@foreach($client->companies as $company) @if($client->id == $company->client_id)
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
                <div class="mb-4 w-6/12 px-2">
                    <label for="client_name">Client Name</label>
                    <input type="text" name="client_name" id="client_name" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('client_name') border-red-500 @enderror" value="{{ old('client_name') }}">
                    @error('client_name')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2">
                    <label for="client_surname">Client Surname</label>
                    <input type="text" name="client_surname" id="client_surname" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('client_surname') border-red-500 @enderror" value="{{ old('client_surname') }}">
                    @error('client_surname')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2">
                    <label for="client_id_number">Client ID Number</label>
                    <input type="text" name="client_id_number" id="client_id_number" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('client_id_number') border-red-500 @enderror" value="{{ old('client_id_number') }}">
                    @error('client_id_number')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2">
                    <label for="client_cellphone">Client Cellphone Number</label>
                    <input type="text" name="client_cellphone" id="client_cellphone" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('client_cellphone') border-red-500 @enderror" value="{{ old('client_cellphone') }}">
                    @error('client_cellphone')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-5 w-6/12 px-2">
                    <label for="client_email">Client Email</label>
                    <input type="text" name="client_email" id="client_email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('client_email') border-red-500 @enderror" value="{{ old('client_email') }}">
                    @error('client_email')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2">
                    <label for="client_id">Client Type</label>
                    <select name="client_type" id="client_type" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('client_type') border-red-500 @enderror" value="{{ old('client_type') }}" required>
                        <option value="not specified">Not specified</option>
                        <option value="retainer client">Retainer Client</option>
                        <option value="cash client">Cash Client</option>
                    </select>
                    @error('client_id')
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
