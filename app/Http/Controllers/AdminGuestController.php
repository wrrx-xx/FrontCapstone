<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TenantProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminGuestController extends Controller
{
    public function index()
    {
        $guests = User::where('role', 'guest')->with('tenantProfile')->get();

        return view('admin.guest.index', compact('guests'));
    }

    public function create()
    {
        return view('admin.guest.create');
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
            'current_address' => ['nullable', 'string', 'max:255'],
            'employment_status' => ['nullable', 'string', 'max:255'],
            'monthly_income' => ['nullable', 'numeric'],
            'emergency_contact_name' => ['nullable', 'string', 'max:255'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:20'],
            'valid_id_type' => ['nullable', 'string', 'max:255'],
            'valid_id_front_path' => ['nullable', 'string', 'max:255'],
            'valid_id_back_path' => ['nullable', 'string', 'max:255'],
        ]);

        $guest = User::create([
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'role' => 'guest',
        ]);

        $guest->tenantProfile()->create([
            'current_address' => $request->current_address,
            'employment_status' => $request->employment_status,
            'monthly_income' => $request->monthly_income,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'valid_id_type' => $request->valid_id_type,
            'valid_id_front_path' => $request->valid_id_front_path,
            'valid_id_back_path' => $request->valid_id_back_path,
        ]);

        return redirect()->route('admin.guest.index')->with('success', 'Guest created successfully.');
    }

    public function edit($id)
    {
        $guest = User::where('role', 'guest')->with('tenantProfile')->findOrFail($id);

        return view('admin.guest.edit', compact('guest'));
    }

    public function update(Request $request, $id)
    {
        $guest = User::where('role', 'guest')->with('tenantProfile')->findOrFail($id);

        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['nullable', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($guest->id)],
            'phone_number' => ['required', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'current_address' => ['nullable', 'string', 'max:255'],
            'employment_status' => ['nullable', 'string', 'max:255'],
            'monthly_income' => ['nullable', 'numeric'],
            'emergency_contact_name' => ['nullable', 'string', 'max:255'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:20'],
            'valid_id_type' => ['nullable', 'string', 'max:255'],
            'valid_id_front_path' => ['nullable', 'string', 'max:255'],
            'valid_id_back_path' => ['nullable', 'string', 'max:255'],
        ]);

        $guest->fname = $request->fname;
        $guest->mname = $request->mname;
        $guest->lname = $request->lname;
        $guest->email = $request->email;
        $guest->phone_number = $request->phone_number;

        if ($request->filled('password')) {
            $guest->password = Hash::make($request->password);
        }

        $guest->save();

        $tenantProfile = $guest->tenantProfile;
        if (!$tenantProfile) {
            $tenantProfile = new TenantProfile();
            $tenantProfile->user_id = $guest->id;
        }

        $tenantProfile->current_address = $request->current_address;
        $tenantProfile->employment_status = $request->employment_status;
        $tenantProfile->monthly_income = $request->monthly_income;
        $tenantProfile->emergency_contact_name = $request->emergency_contact_name;
        $tenantProfile->emergency_contact_phone = $request->emergency_contact_phone;
        $tenantProfile->valid_id_type = $request->valid_id_type;
        $tenantProfile->valid_id_front_path = $request->valid_id_front_path;
        $tenantProfile->valid_id_back_path = $request->valid_id_back_path;

        $tenantProfile->save();

        return redirect()->route('admin.guest.index')->with('success', 'Guest updated successfully.');
    }

    public function destroy($id)
    {
        $guest = User::where('role', 'guest')->findOrFail($id);
        $guest->delete();

        return redirect()->route('admin.guest.index')->with('success', 'Guest deleted successfully.');
    }
}
