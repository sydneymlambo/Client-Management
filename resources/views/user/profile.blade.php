@extends('layouts.app')
@section('body-id', 'profile')
@section('content')
    @if(auth()->user()->user_role < 3)
        <div class="flex justify-center mt-5">
            <div class="w-10/12 p-5 mx-auto bg-white rounded">
                <h1 class="text-center">Your Profile</h1>

                <div class="mt-5 flex flex-wrap">
                    <div class="w-6/12 py-4">
                        Name: <br>
                        {{ auth()->user()->name }}
                    </div>
                    <div class="w-6/12 py-4">
                        Surname: <br>
                        {{ auth()->user()->surname }}
                    </div>
                    <div class="w-6/12 py-4">
                        Username: <br>
                        {{ auth()->user()->username }}
                    </div>
                    <div class="w-6/12 py-4">
                        Email: <br>
                        {{ auth()->user()->email }}
                    </div>
                    <div class="w-6/12 py-4">
                        Profile created at: <br>
                        {{ auth()->user()->created_at }}
                    </div>

                    <div class="w-6/12 py-4">
                        User Role: <br>
                        @if(auth()->user()->user_role == 1) Administrator @else Normal User @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>You don't have access to this page</p>
    @endif
@endsection