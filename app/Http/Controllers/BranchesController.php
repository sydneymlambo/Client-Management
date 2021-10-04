<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class BranchesController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, [
            'company_id' => 'required',
            'contact' => 'required|min:9',
        ]);

        //Store
        Branch::create([
            'company_id' => $request->company_id,
            'contact' => $request->contact,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code
        ]);

        return back();
    }

    public function destroy(Branch $branch) {
        $branch->delete();

        return back();
    }
}
