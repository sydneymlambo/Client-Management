<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentsController extends Controller
{
    public function index() {
        $data = Document::all();

        return view('documents', compact('data'));
    }

    public function store(Request $request) {

        $data = new document();

        $file = $request->file;
        $filename = time().'.'.$file->getClientOriginalExtension();
        $request->file->move('assets', $filename);
        $data->file = $filename;

        $data->doc_name = $request->doc_name;
        $data->description = $request->description;

        $data->save();

        return redirect()->back();
    }

    public function download(Request $request, $document) {
        return response()->download(public_path('assets/'.$document));
    }
}
