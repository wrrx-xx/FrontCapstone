<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CaretakerController extends Controller
{
    public function create()
    {
        return view('caretaker.create');
    }

    public function index()
    {
        $caretakers = User::where('owner_id', Auth::id())
            ->where('role', 'caretaker')
            ->get();
            
        return view('caretaker.index', compact('caretakers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'owner_id' => Auth::id(),
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'role' => 'caretaker',
        ]);

        return redirect()->route('caretaker.index')->with('success', 'Caretaker created successfully!');
    }

    public function edit(User $caretaker)
    {
        // Ensure the caretaker belongs to the current owner
        if ($caretaker->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('caretaker.edit', compact('caretaker'));
    }

    public function update(Request $request, User $caretaker)
    {
        // Ensure the caretaker belongs to the current owner
        if ($caretaker->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$caretaker->id,
            'phone_number' => 'required|string|max:15',
        ]);

        $caretaker->update([
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('caretaker.index')->with('success', 'Caretaker updated successfully!');
    }

    public function destroy(User $caretaker)
    {
        // Ensure the caretaker belongs to the current owner
        if ($caretaker->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $caretaker->delete();

        return redirect()->route('caretaker.index')->with('success', 'Caretaker deleted successfully!');
    }
}
