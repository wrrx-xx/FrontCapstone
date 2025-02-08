<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index(){
        return view('dashboard');
    }
    public function outindex(){
        return view('dashboard');
    }
}