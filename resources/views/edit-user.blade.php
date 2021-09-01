@extends('layouts.app')
@section('content')
    <div class="flex flex-wrap justify-center">
        <div class="w-8/12 bg-white p-6 text-center">
            <h1>Edit User</h1>
        </div>
        <div class="w-8/12 bg-white p-6">
            @if(auth()->user()->user_role == 1)
                <form action="{{ url('/update/user') }}" method="post" class="flex flex-wrap">
                    @csrf
                    <div class="mb-4 w-6/12 px-2 hidden">
                        <input type="text" name="id" id="id" class="bg-gray-100 border-2 w-full p-4 rounded-lg border-red-500" value="{{ $user->id }}">
                    </div>
                    <div class="mb-4 w-6/12 px-2">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" value="{{ $user->name }}">
                        @error('name')
                        <div class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4 w-6/12 px-2">
                        <label for="surname">Surname</label>
                        <input type="text" name="surname" id="surname" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('surname') border-red-500 @enderror" value="{{ $user->surname }}">
                        @error('surname')
                        <div class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4 w-6/12 px-2">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('username') border-red-500 @enderror" value="{{ $user->username }}">
                        @error('username')
                        <div class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4 w-6/12 px-2">
                        <label for="user_role">User Role</label>
                        <select name="user_role" id="user_role" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('user_role') border-red-500 @enderror" required="required">
                            <option @if($user->user_role == 1) selected @endif value="1">Administrator</option>
                            <option @if($user->user_role == 2) selected @endif value="2">Normal User</option>
                        </select>
                        @error('user_role')
                        <div class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4 w-full px-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ $user->email }}">
                        @error('email')
                        <div class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4 w-full px-4">
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </div>
                </form>
            @else
                <strong>You do not have access to this page please contact your supervisor for assistance</strong>
            @endif
        </div>
    </div>
@endsection