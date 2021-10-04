@extends('layouts.app')
@section('body-id', 'document-repo')
@section('content')
    <div class="flex flex-wrap justify-center mt-5">
        <div class="w-full p-5 mx-auto">
            <form class="flex flex-wrap items-center" action="{{ route('document-repository') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="w-1/4 p-3">
                    <input class="bg-gray-100 border-2 w-full p-4 rounded-lg" type="text" name="doc_name" placeholder="Document Name">
                    @error('doc_name')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="1/4 p-3">
                    <input class="bg-gray-100 border-2 w-full p-4 rounded-lg" type="text" name="description" placeholder="Description">
                    @error('description')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="w-1/4 p-3">
                    <select name="client_id" id="client_id" class="@error('client_id') border-red-500 @enderror" value="{{ old('client_id') }}" required>
                        @foreach($clients as $client)
                            @if(auth()->user()->user_role < 3 )
                                <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                            @elseif(auth()->user()->email == $client->client_email)
                                <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="client_id">Document Owner</label>
                    @error('client_id')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="w-1/4 p-3">
                    <input  type="file" name="file">
                </div>
                <div class="w-1/2 mx-auto">
                    <input class="btn btn-primary btn-block" type="submit" value="Upload">
                </div>
            </form>
        </div>
        <div class="w-full p-5 mx-auto">
            <div class="search pt-5">
                <input id="search" type="text" class="form-control"  placeholder="Search for Documents......">
            </div>
            @if(auth()->user()->user_role == 1)
            <table class="w-full striped">
                <thead>
                    <tr class="text-left">
                        <th class="">Document Name</th>
                        <th>Document Owner</th>
                        <th class="">Document Description</th>
                        <th class="">Uploaded at</th>
                        <th class="">Download</th>
                    </tr>
                </thead>
                <tbody id="table">
                    @foreach($data as $data)
                        <tr>
                            <td class="">{{ $data->doc_name }}</td>
                            <td>@if(!empty($data->clients->client_name)){{ $data->clients->client_name }}@endif</td>
                            <td class="">{{ $data->description }}</td>
                            <td class="">{{ $data->created_at }}</td>
                            <td class=""><a href="{{ url('/download', $data->file) }}" class="btn btn-primary btn-block text-center">Download</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @elseif(auth()->user()->user_role == 3)
                <table class="w-full striped">
                    <thead>
                        <tr class="text-left">
                            <th class="">Document Name</th>
                            <th>Document Owner</th>
                            <th class="">Document Description</th>
                            <th class="">Uploaded at</th>
                            <th class="">Download</th>
                        </tr>
                    </thead>
                    <tbody id="table">
                    @foreach($data as $data)
                        @if(auth()->user()->email == $data->clients->client_email )
                            <tr>
                                <td class="">{{ $data->doc_name }}</td>
                                <td>{{ $data->clients->client_name }}</td>
                                <td class="">{{ $data->description }}</td>
                                <td class="">{{ $data->created_at }}</td>
                                <td class=""><a href="{{ url('/download', $data->file) }}" class="btn btn-primary btn-block text-center">Download</a></td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-red-800 text-bold">You currently do not have permissions to view these records</p>
            @endif
        </div>
    </div>
@endsection
