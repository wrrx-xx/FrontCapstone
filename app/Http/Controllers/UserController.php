<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Ownerindex(){
        return view('owner.dashboard');
    }
}
