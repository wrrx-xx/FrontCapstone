<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TenantProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminTenantController extends Controller
{
    public function index()
    {
        $tenants = User::where('role', 'tenant')->with('tenantProfile')->get();

        return view('admin.tenant.index', compact('tenants'));
    }

    public function create()
    {
        return view('admin.tenant.create');
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

        $tenant = User::create([
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'role' => 'tenant',
        ]);

        $tenant->tenantProfile()->create([
            'current_address' => $request->current_address,
            'employment_status' => $request->employment_status,
            'monthly_income' => $request->monthly_income,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'valid_id_type' => $request->valid_id_type,
            'valid_id_front_path' => $request->valid_id_front_path,
            'valid_id_back_path' => $request->valid_id_back_path,
        ]);

        return redirect()->route('admin.tenant.index')->with('success', 'Tenant created successfully.');
    }

    public function edit($id)
    {
        $tenant = User::where('role', 'tenant')->with('tenantProfile')->findOrFail($id);

        return view('admin.tenant.edit', compact('tenant'));
    }

    public function update(Request $request, $id)
    {
        $tenant = User::where('role', 'tenant')->with('tenantProfile')->findOrFail($id);

        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['nullable', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($tenant->id)],
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

        $tenant->fname = $request->fname;
        $tenant->mname = $request->mname;
        $tenant->lname = $request->lname;
        $tenant->email = $request->email;
        $tenant->phone_number = $request->phone_number;

        if ($request->filled('password')) {
            $tenant->password = Hash::make($request->password);
        }

        $tenant->save();

        $tenantProfile = $tenant->tenantProfile;
        if (!$tenantProfile) {
            $tenantProfile = new TenantProfile();
            $tenantProfile->user_id = $tenant->id;
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

        return redirect()->route('admin.tenant.index')->with('success', 'Tenant updated successfully.');
    }

    public function destroy($id)
    {
        $tenant = User::where('role', 'tenant')->findOrFail($id);
        $tenant->delete();

        return redirect()->route('admin.tenant.index')->with('success', 'Tenant deleted successfully.');
    }
}
