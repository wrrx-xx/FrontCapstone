<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminCaretakerController extends Controller
{
     public function index()
    {
        // Retrieve all owners with their caretakers eager loaded
        $owners = User::where('role', 'owner')->with('caretakers')->get();

        return view('admin.caretaker.index', compact('owners'));
    }
    public function create(Request $request)
    {
        $ownerId = $request->query('owner_id');
        $owner = User::findOrFail($ownerId);

        return view('admin.caretaker.create', compact('owner'));
    }

    // Store a new caretaker
    public function store(Request $request)
    {
        $request->validate([
            'owner_id' => ['required', 'exists:users,id'],
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone_number' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'owner_id' => $request->owner_id,
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'role' => 'caretaker',
        ]);

        return redirect()->route('admin.caretaker.index')->with('success', 'Caretaker created successfully.');
    }

    // Show form to edit an existing caretaker
    public function edit($id)
    {
        $caretaker = User::where('role', 'caretaker')->findOrFail($id);
        $owner = $caretaker->owner;

        return view('admin.caretaker.edit', compact('caretaker', 'owner'));
    }

    // Update an existing caretaker
    public function update(Request $request, $id)
    {
        $caretaker = User::where('role', 'caretaker')->findOrFail($id);

        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($caretaker->id)],
            'phone_number' => ['required', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $caretaker->fname = $request->fname;
         $caretaker->lname = $request->mname;
        $caretaker->lname = $request->lname;
        $caretaker->email = $request->email;
        $caretaker->phone_number = $request->phone_number;

        if ($request->filled('password')) {
            $caretaker->password = Hash::make($request->password);
        }

        $caretaker->save();

        return redirect()->route('admin.caretaker.index')->with('success', 'Caretaker updated successfully.');
    }

    // Delete a caretaker
    public function destroy($id)
    {
        $caretaker = User::where('role', 'caretaker')->findOrFail($id);
        $caretaker->delete();

        return redirect()->route('admin.caretaker.index')->with('success', 'Caretaker deleted successfully.');
    }
}
