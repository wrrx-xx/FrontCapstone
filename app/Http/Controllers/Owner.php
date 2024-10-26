<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Owner extends Controller
{
    public function index(){
        return view('owner.dashboard');
    }
    
}
