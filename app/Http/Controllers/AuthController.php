<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Logger\ConsoleLogger;

class AuthController extends Controller
{   
    public function index(){
        return view('auth.login');
    }
    public function create(){
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $fields = $request->validate([
            'fname' => 'required|max:255',
            'mname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|max:255',
            'password' => 'required|confirmed',
            'role' => 'nullable',
        ]);

        $user = User::create($fields);

        $token = $user->createToken($request->email);
        // return [
        //     'user' => $user,
        //     'token' => $token->plainTextToken
        // ];
        return redirect()->route('tenant.dashboard');
    
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ])->withInput();
    }

    // Log the user in
    Auth::login($user);

    // Redirect based on user role
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');  // Change to the actual route for admin
    } elseif ($user->role === 'owner') {
        return redirect()->route('owner'); // Change to the actual route for owner
    } else {
        return redirect()->route('tenant.dashboard'); // Change to the actual route for tenant
    }
}
    public function ownerlogin(){
        return view('owner.dashboard');
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return redirect('/');
    }
}