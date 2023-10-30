<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthCustomController extends Controller
{
    public function adult(){
        return view('adults.adult');
    }
}