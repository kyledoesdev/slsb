<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class DashboardController extends Controller {

    public function index(Request $request) {
        return view('dashboard');
    }

}
