@extends('layouts.app')
@section('body-id', 'document-repo')
@section('content')
    <div class="flex flex-wrap justify-center mt-5">
        <div class="heading w-10/12 p-5 mx-auto">
            <h1>Document Repository</h1>
        </div>
        <div class="w-10/12 p-5 mx-auto">
            <form class="flex flex-wrap items-center" action="{{ route('document-repository') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="w-3/12 p-3">
                    <input class="bg-gray-100 border-2 w-full p-4 rounded-lg" type="text" name="doc_name" placeholder="Document Name">
                </div>
                <div class="w-3/12 p-3">
                    <input class="bg-gray-100 border-2 w-full p-4 rounded-lg" type="text" name="description" placeholder="Description">
                </div>
                <div class="w-3/12 p-3">
                    <input  type="file" name="file">
                </div>
                <div class="w-3/12">
                    <input class="btn btn-primary btn-block" type="submit" value="Upload">
                </div>
            </form>
        </div>
        <div class="w-10/12 p-5 mx-auto bg-primary-fade rounded">
            <table class="w-full">
                <tr>
                    <th class="p-3 border border-red-800">Document Name</th>
                    <th class="p-3 border border-red-800">Document Description</th>
                    <th class="p-3 border border-red-800">Uploaded at</th>
                    <th class="p-3 border border-red-800">Download</th>
                </tr>
                @foreach($data as $data)
                    <tr>
                        <td class="p-3 border border-red-800">{{ $data->doc_name }}</td>
                        <td class="p-3 border border-red-800">{{ $data->description }}</td>
                        <td class="p-3 border border-red-800">{{ $data->created_at }}</td>
                        <td class="p-3 border border-red-800"><a href="{{ url('/download', $data->file) }}" class="btn btn-primary btn-block text-center">Download</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection