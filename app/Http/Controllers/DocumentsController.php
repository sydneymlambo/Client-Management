<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Client;

class DocumentsController extends Controller
{
    public function index() {
        $data = Document::with('clients')->get();
        $clients = Client::get();

        $title = 'Documents';
        return view('documents', compact('data'), [
            'clients' => $clients,
            'title' => $title,
        ]);
    }

    public function store(Request $request) {

        $data = new document();

        $this->validate($request, [
            'file' => 'required',
            'doc_name' => 'required|min:1',
            'description' => 'required|min:1',
            'client_id' => 'required|min:1',
        ]);

        $file = $request->file;
        $filename = time().'.'.$file->getClientOriginalExtension();
        $request->file->move('assets', $filename);
        $data->file = $filename;

        $data->doc_name = $request->doc_name;
        $data->description = $request->description;
        $data->client_id = $request->client_id;

        $data->save();

        return redirect()->back();
    }

    public function download(Request $request, $document) {
        return response()->download(public_path('assets/'.$document));
    }
}
