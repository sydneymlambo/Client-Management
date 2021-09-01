@extends('layouts.app')
@section('body-id', 'users')
@section('content')
    <div class="flex justify-center mt-5">
        <div class="w-10/12 p-5 mx-auto bg-white rounded">
                <div class="rounded bg-primary-fade p-5 mt-3">
                    <table class="table-auto w-full border border-red-800">
                        <thead>
                        <tr class="border-bottom-1 text-left">
                            <th class="p-3 border border-red-800">Name</th>
                            <th class="p-3 border border-red-800">Surname</th>
                            <th class="p-3 border border-red-800">Username</th>
                            <th class="p-3 border border-red-800">Email</th>
                            <th class="p-3 border border-red-800">User Role</th>
                            <th class="p-3 border border-red-800" colspan="2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="p-3 border border-red-800">{{ $user->name }}</td>
                                <td class="p-3 border border-red-800">{{ $user->surname }}</td>
                                <td class="p-3 border border-red-800">{{ $user->username }}</td>
                                <td class="p-3 border border-red-800">{{ $user->email }}</td>
                                <td class="p-3 border border-red-800">{{ $user->user_role }}  @if($user->user_role == 1)Admin User @else Normal User @endif</td>
                                <td class="p-3 border border-red-800">
                                    <form action="{{ route('users.destroy', $user) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete"> <i class="icon icon-delete" style="background-image: url({{ asset('img/bin.png') }})"></i> Delete</button>
                                    </form>
                                </td>
                                <td class="p-3 border border-red-800">
                                    <form action="">
                                        <a href="{{ url('users/edit', $user->id) }}" class="btn btn-edit"><i class="icon icon-edit" style="background-image: url({{ asset('img/edit.png') }})"></i> Edit</a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
@endsection