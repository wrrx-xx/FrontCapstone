<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OwnerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminOwnerController extends Controller
{
    public function index()
    {
        $owners = User::where('role', 'owner')->with('ownerProfile')->get();

        return view('admin.owner.index', compact('owners'));
    }

    public function create()
    {
        return view('admin.owner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['nullable', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone_number' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'business_name' => ['nullable', 'string', 'max:255'],
            'business_address' => ['nullable', 'string', 'max:255'],
            'business_phone' => ['nullable', 'string', 'max:20'],
            'business_email' => ['nullable', 'email', 'max:255'],
            'owner_id_type' => ['nullable', 'string', 'max:255'],
            'owner_id_front_path' => ['nullable', 'string', 'max:255'],
            'owner_id_back_path' => ['nullable', 'string', 'max:255'],
            'additional_info' => ['nullable', 'string'],
            'approved' => ['nullable', 'boolean'],
        ]);

        $owner = User::create([
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'role' => 'owner',
        ]);

        $owner->ownerProfile()->create([
            'business_name' => $request->business_name,
            'business_address' => $request->business_address,
            'business_phone' => $request->business_phone,
            'business_email' => $request->business_email,
            'owner_id_type' => $request->owner_id_type,
            'owner_id_front_path' => $request->owner_id_front_path,
            'owner_id_back_path' => $request->owner_id_back_path,
            'additional_info' => $request->additional_info,
            'approved' => $request->approved ?? false,
        ]);

        return redirect()->route('admin.owner.index')->with('success', 'Owner created successfully.');
    }

    public function edit($id)
    {
        $owner = User::where('role', 'owner')->with('ownerProfile')->findOrFail($id);

        return view('admin.owner.edit', compact('owner'));
    }

    public function update(Request $request, $id)
    {
        $owner = User::where('role', 'owner')->with('ownerProfile')->findOrFail($id);

        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['nullable', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($owner->id)],
            'phone_number' => ['required', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'business_name' => ['nullable', 'string', 'max:255'],
            'business_address' => ['nullable', 'string', 'max:255'],
            'business_phone' => ['nullable', 'string', 'max:20'],
            'business_email' => ['nullable', 'email', 'max:255'],
            'owner_id_type' => ['nullable', 'string', 'max:255'],
            'owner_id_front_path' => ['nullable', 'string', 'max:255'],
            'owner_id_back_path' => ['nullable', 'string', 'max:255'],
            'additional_info' => ['nullable', 'string'],
            'approved' => ['nullable', 'boolean'],
        ]);

        $owner->fname = $request->fname;
        $owner->mname = $request->mname;
        $owner->lname = $request->lname;
        $owner->email = $request->email;
        $owner->phone_number = $request->phone_number;

        if ($request->filled('password')) {
            $owner->password = Hash::make($request->password);
        }

        $owner->save();

        $ownerProfile = $owner->ownerProfile;
        if (!$ownerProfile) {
            $ownerProfile = new OwnerProfile();
            $ownerProfile->user_id = $owner->id;
        }

        $ownerProfile->business_name = $request->business_name;
        $ownerProfile->business_address = $request->business_address;
        $ownerProfile->business_phone = $request->business_phone;
        $ownerProfile->business_email = $request->business_email;
        $ownerProfile->owner_id_type = $request->owner_id_type;
        $ownerProfile->owner_id_front_path = $request->owner_id_front_path;
        $ownerProfile->owner_id_back_path = $request->owner_id_back_path;
        $ownerProfile->additional_info = $request->additional_info;
        $ownerProfile->approved = $request->approved ?? false;

        $ownerProfile->save();

        return redirect()->route('admin.owner.index')->with('success', 'Owner updated successfully.');
    }

    public function destroy($id)
    {
        $owner = User::where('role', 'owner')->findOrFail($id);
        $owner->delete();

        return redirect()->route('admin.owner.index')->with('success', 'Owner deleted successfully.');
    }
}
