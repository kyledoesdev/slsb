<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAccountSettingsController extends Controller {

    public function index($id) {
       return view('settings.index');
    }

}
