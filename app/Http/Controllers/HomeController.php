<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $title = "";
        return view('home', [
            'title' => $title,
        ]);
    }
}
