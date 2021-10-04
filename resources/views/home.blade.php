@extends('layouts.app')
@section('body-id', 'home')
@section('content')
    <div class="flex justify-center mt-5 home-actions mx-auto">
        @if(auth()->user()->user_role < 3)
            <a href="{{ route('dashboard') }}" class="action">
                Dashboard
            </a>
        @endif
        @if(auth()->user()->user_role == 1)
            <a href="{{ route('register') }}" class="action">
                Register New user
            </a>
        @endif
        <form class="action" action="{{ route('logout') }}" method="post">
            @csrf
            <button class="p-3">Logout</button>
        </form>
    </div>
@endsection