@extends('layouts.app')
@section('body-id', 'clients')
@section('content')
    <div class="flex justify-center mt-5">
        <div class="w-full p-5 mx-auto bg-white rounded">
            <div class="add-button py-4">
                <a href="#register-client" class="modal-btn waves-effect waves-light btn"><i class="icon icon-edit" style="background-image: url({{ asset('img/plus.png') }});"></i> Add Remark</a><a class="ml-5 btn btn-primary print-btn">Print</a>
            </div>
            <div class="search">
                <input id="search" type="text" class="form-control"  placeholder="Search for record......">
            </div>
            @if(count($remarks))
                <div id="table" class="flex flex-wrap w-full">
                    @foreach($remarks as $remark)
                        <div class="w-1/3 p-3">
                            <div class="w-full bg-primary-fade p-5 rounded mb-3">

                                <p class="mb-3">
                                    <strong>Client Name</strong> <br>
                                    {{ $remark->client_name }}
                                </p>

                                <p class="mb-3">
                                    <strong>Subject</strong> <br>
                                    {{ $remark->subject }}
                                </p>

                                <p class="mb-3">
                                    <strong>Remark</strong> <br>
                                    {{ $remark->remark }}
                                </p>

                                <form class="py-4" action="{{ route('cutomerRemark.destroy', $remark) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete"> <i class="icon icon-delete" style="background-image: url({{ asset('img/bin.png') }})"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                No Remarks
            @endif
        </div>
    </div>

    <div class="flex justify-center register-modal hide modal">
        <div class="overlay"></div>
        <div class="w-10/12 p-5 mx-auto bg-white rounded register-form">
            <div class="pb-4 text-right">
                <button class="close"><i class="icon icon-close" style="background-image: url({{ asset('img/close.png') }})"></i></button>
            </div>
            <form action="{{ route('clients-remarks') }}" method="post" class="mb-4 flex flex-wrap ">
                @csrf
                <div class="mb-4 w-6/12 px-2 input-field">
                    <select name="client_name" id="client_name" class="w-full p-4 rounded-lg @error('client_name') @enderror" value="{{ old('client_name') }}">
                        @foreach($clients as $client)
                            <option value="{{ $client->client_name }}">{{ $client->client_name }}</option>
                        @endforeach
                    </select>
                    <label for="client_name">Client Name</label>
                    @error('client_name')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-6/12 px-2 input-field">
                    <input type="text" name="subject" id="subject" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('subject') border-red-500 @enderror" value="{{ old('subject') }}">
                    <label for="subject">Subject</label>
                    @error('subject')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-4 w-full px-2 input-field">
                    <textarea type="text" name="remark" id="remark" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('remark') border-red-500 @enderror" value="{{ old('remark') }}" rows="10"></textarea>
                    <label for="remark">Remark</label>
                    @error('remark')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mt-5 w-8/12 mx-auto">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                </div>
            </form>
        </div>
    </div>
@endsection
