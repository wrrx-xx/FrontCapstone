<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Listing extends Controller
{
    public function index()
    {
        return view('gridlisting.index');
    }
}
