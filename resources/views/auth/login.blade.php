@extends('layouts.app')
@section('body-id', 'login')
@section('content')
    <div class="w-full flex justify-center mt-10">
        <div class="w-1/3 bg-white p-6 rounded-lg">
            <div class="text-center pb-10">
                <h1>LOGIN</h1>
            </div>
            @if(session('status'))
                <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('login') }}" method="post" class="flex flex-wrap">
                @csrf

                <div class="mb-4 w-full px-2 input-field">
                    <input type="email" name="email" id="email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                    <label for="email">Email</label>
                    @error('email')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 w-full px-2 input-field">
                    <input type="password" name="password" id="password" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror">
                    <label for="password">Password</label>
                    @error('password')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 w-full px-4">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection