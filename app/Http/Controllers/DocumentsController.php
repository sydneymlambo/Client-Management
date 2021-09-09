<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Company;

class DocumentsController extends Controller
{
    public function index() {
        $data = Document::all();
        $companies = Company::get('company_name');

        return view('documents', compact('data'), [
            'companies' => $companies,
        ]);
    }

    public function store(Request $request) {

        $data = new document();

        $this->validate($request, [
            'file' => 'required',
            'doc_name' => 'required|min:1',
            'description' => 'required|min:1',
            'company_name' => 'required|min:1',
        ]);

        $file = $request->file;
        $filename = time().'.'.$file->getClientOriginalExtension();
        $request->file->move('assets', $filename);
        $data->file = $filename;

        $data->doc_name = $request->doc_name;
        $data->description = $request->description;
        $data->company_name = $request->company_name;

        $data->save();

        return redirect()->back();
    }

    public function download(Request $request, $document) {
        return response()->download(public_path('assets/'.$document));
    }
}
