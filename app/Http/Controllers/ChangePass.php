<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangePass extends Controller
{
    public function ChangePassword(){

        return view('admin.body.change_password');

    }
}
