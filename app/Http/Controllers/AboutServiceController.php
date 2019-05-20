<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutServiceController extends Controller {
    public function index() {
        return view('about');
    }
}
