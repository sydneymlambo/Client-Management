@extends('layouts.app')
@section('body-id', 'dashboard')
@section('content')
    <div class="flex flex-wrap justify-center mt-5">
        <div class="heading w-10/12 p-5 mx-auto">
            <h1>DASHBOARD</h1>
        </div>
        <div class="w-10/12 p-5 mx-auto bg-white flex flex-wrap">
            <div class="px-5 mb-5 w-full">
                <a href="#register-client" class="modal-btn btn btn-primary"><i class="icon icon-edit" style="background-image: url({{ asset('img/plus.png') }});"></i> Set a reminder note</a>
            </div>
            <div class="w-6/12 p-5 reminders">
                <div class="p-5 w-full">
                    <h3 class="text-center">Reminders</h3>
                </div>
                @foreach($reminders as $reminder)
                    @if(auth()->user()->user_role === 1)
                        <div class="w-full bg-primary-fade p-5 rounded mb-3">

                            <p class="mb-3">
                                <strong>Reminder for</strong> <br>
                                {{ $reminder->users->name }}
                            </p>

                            <p class="mb-3">
                                <strong>Subject</strong> <br>
                                {{ $reminder->subject }}
                            </p>

                            <p class="mb-3">
                                <strong>Note</strong> <br>
                                {{ $reminder->note }}
                            </p>

                            <p>
                                <strong>Date</strong> <br>
                                {{ $reminder->reminder_date }}
                            </p>

                            <form class="py-4" action="{{ route('dashboard.destroy', $reminder) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete"> <i class="icon icon-delete" style="background-image: url({{ asset('img/bin.png') }})"></i> Delete</button>
                            </form>
                        </div>
                    @elseif($reminder->users->username === auth()->user()->username )
                        <div class="w-full bg-primary-fade p-5 rounded mb-3">

                            <p class="mb-3">
                                <strong>Reminder for</strong> <br>
                                {{ $reminder->users->name }}
                            </p>

                            <p class="mb-3">
                                <strong>Subject</strong> <br>
                                {{ $reminder->subject }}
                            </p>

                            <p class="mb-3">
                                <strong>Note</strong> <br>
                                {{ $reminder->note }}
                            </p>

                            <p>
                                <strong>Date</strong> <br>
                                {{ $reminder->reminder_date }}
                            </p>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="w-6/12 p-5 alerts">
                <div class="p-5 w-full">
                    <h3 class="text-center">Company Alerts</h3>
                </div>
                <div class="w-full bg-primary-fade p-5 rounded mb-3">
                    <h4 class="text-center">Companies in need of renewal</h4>
                    <table class="w-full">
                        <tr class="text-left">
                            <th class="p-3 border border-red-800">Company Name</th>
                            <th class="p-3 border border-red-800">Days Left to renew</th>
                        </tr>
                        @foreach($companies as $company)
                            <?php
                            $date_diff = date_diff($current_date, date_create($company->company_renewal));
                            $days = str_replace("+", "",$date_diff->format("%R%a"));
                            ?>

                            @if($days < 90)
                                <tr>
                                    <td class="p-3 border border-red-800">{{ $company->company_name }}</td>
                                    <td class="p-3 border border-red-800">{{ $days }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
                <div class="w-full bg-primary-fade p-5 rounded mb-3">
                    <h4 class="text-center">Companies with high initial balances</h4>
                    <table class="w-full">
                        <tr class="text-left">
                            <th class="p-3 border border-red-800">Company Name</th>
                            <th class="p-3 border border-red-800">Initial balance</th>
                        </tr>
                        @foreach($companies as $company)
                            @if($company->initial_payment_balance > 5000)
                            <tr>
                                <td class="p-3 border border-red-800">{{ $company->company_name }}</td>
                                <td class="p-3 border border-red-800">{{ $company->initial_payment_balance }}</td>
                            </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="flex justify-center register-modal hide modal">
        <div class="overlay"></div>
        <div class="w-10/12 p-5 mx-auto bg-white rounded register-form">
            <div class="pb-4 text-right">
                <button class="close"><i class="icon icon-close" style="background-image: url({{ asset('img/close.png') }})"></i></button>
            </div>
            <form action="{{ route('dashboard') }}" method="post" class="mb-4 flex flex-wrap ">
                @csrf

                <div class="mb-4 w-6/12 px-2">
                    <label for="user_id">Reminder For</label>
                    <select name="user_id" id="user_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('user_id') border-red-500 @enderror" value="{{ old('user_id') }}" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 w-6/12 px-2">
                    <label for="subject">Subject</label>
                    <input type="text" name="subject" id="subject" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('subject') border-red-500 @enderror" value="{{ old('subject') }}" required>
                    @error('subject')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 w-full px-2">
                    <label for="note">Note</label>
                    <textarea rows="10" name="note" id="note" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('note') border-red-500 @enderror" value="{{ old('note') }}" required></textarea>
                    @error('note')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 w-6/12 px-2">
                    <label for="email">Email to</label>
                    <select name="email" id="email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
                        @foreach($users as $user)
                            <option value="{{ $user->email }}">{{ $user->name }} --- {{ $user->email }}</option>
                        @endforeach
                    </select>
                    @error('email')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 w-6/12 px-2">
                    <label for="reminder_date">Reminder date</label>
                    <input type="date" name="reminder_date" id="reminder_date" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('reminder_date') border-red-500 @enderror" value="{{ old('reminder_date') }}" required>
                    @error('reminder_date')
                    <div class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mt-5 w-8/12 mx-auto">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
