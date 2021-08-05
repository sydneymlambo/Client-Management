@extends('layouts.app')
@section('body-id', 'home')
@section('content')
    <div class="flex justify-center mt-5 home-actions mx-auto">
        <a href="{{ route('dashboard') }}" class="action">
            Dashboard
        </a>

        <a href="#" class="action">
            Register New user
        </a>

        <a href="#" class="action">
            Logout
        </a>
    </div>
@endsection