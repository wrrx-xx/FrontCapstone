<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Logger\ConsoleLogger;

class AuthController extends Controller
{   
    public function index(){
        return view('sign.login');
    }
    public function create(){
        return view('sign.register');
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
        return view('dashboard');
    
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:users',
    //         'password' => 'required'
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if (!$user || !Hash::check($request->password, $user->password)) {
    //         return [
    //             'errors' => [
    //                 'email' => ['The provided credentials are incorrect.']
    //             ]
    //         ];
    //         // return [
    //         //     'message' => 'The provided credentials are incorrect.' 
    //         // ];
           
    //     }

    //     $token = $user->createToken($user->email);

    //     // Check user role and redirect accordingly
    //     if ($user->role === 'admin') {
    //         return redirect()->route('admin.dashboard'); // Change to the actual route for admin
    //     } elseif ($user->role === 'owner') {
    //         return redirect()->route('owner'); // Change to the actual route for owner
    //     } else {
    //         return redirect()->route('dashboard'); // Fallback route if the role is not recognized
    //     }
    // }


    // comment this function or remove I used this for postman testing
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'errors' => [
                'email' => ['The provided credentials are incorrect.']
            ]
        ], 401); // Unauthorized response
    }

    // Create a token for the user
    $token = $user->createToken($user->email)->plainTextToken;

    // Return a success response with user information and token
    return response()->json([
        'message' => 'Login successful',
        'token' => $token,
        'user' => [
            'id' => $user->id,
            'email' => $user->email,
            'role' => $user->role,
            // Add any other user details you want to return
        ]
    ], 200); // OK response
}


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return view('auth.login');
    }
}