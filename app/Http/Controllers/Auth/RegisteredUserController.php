<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OwnerProfile;
use App\Models\TenantProfile;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Notifications\NewOwnerRegistered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse

    {
    
        try {
    
            // Validate the request data
    
            $validationRules = [
                'fname' => 'required|string|max:255',
                'mname' => 'nullable|string|max:255',
                'lname' => 'required|string|max:255',
                'email' => 'required|string|lowercase|email|max:255|unique:users',
                'phone_number' => 'required|string|max:20',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role' => 'required|in:guest,owner',
            ];

            // Add tenant-specific validation if role is tenant
            if ($request->role === 'guest') {
                $validationRules += [
                    'current_address' => 'nullable|string|max:255',
                    'employment_status' => 'nullable|string|max:255',
                    'monthly_income' => 'nullable|numeric',
                    'emergency_contact_name' => 'nullable|string|max:255',
                    'emergency_contact_phone' => 'nullable|string|max:20',
                    'valid_id_type' => 'nullable|string|max:255',
                    'valid_id_front' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'valid_id_back' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                ];
            }

            // Add owner-specific validation if role is owner
            if ($request->role === 'owner') {
                $validationRules += [
                    'business_name' => 'required|string|max:255',
                    'business_address' => 'required|string|max:255',
                    'business_phone' => 'required|string|max:20',
                    'owner_id_type' => 'required|string|max:255',
                    'owner_id_front' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'owner_id_back' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                ];
            }

            $request->validate($validationRules);

            // Create the user
            $user = User::create([
                'fname' => $request->fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            if ($request->role === 'owner') {
                // Handle owner ID file uploads
                $ownerIdFrontPath = $request->file('owner_id_front') ?
                    $request->file('owner_id_front')->store('owner_ids/front', 'public') : null;
                $ownerIdBackPath = $request->file('owner_id_back') ?
                    $request->file('owner_id_back')->store('owner_ids/back', 'public') : null;

                // Create the owner profile
                OwnerProfile::create([
                    'user_id' => $user->id,
                    'business_name' => $request->business_name,
                    'business_address' => $request->business_address,
                    'business_phone' => $request->business_phone,
                    'owner_id_type' => $request->owner_id_type,
                    'owner_id_front_path' => $ownerIdFrontPath,
                    'owner_id_back_path' => $ownerIdBackPath,
                ]);

                // Notify admins about new owner registration
                $admins = User::where('role', 'admin')->get();
                Notification::send($admins, new NewOwnerRegistered($user));
            } elseif ($request->role === 'guest') {
                // Handle tenant valid ID file uploads
                $validIdFrontPath = $request->file('valid_id_front') ?
                    $request->file('valid_id_front')->store('tenant_ids/front', 'public') : null;
                $validIdBackPath = $request->file('valid_id_back') ?
                    $request->file('valid_id_back')->store('tenant_ids/back', 'public') : null;

                // Create the tenant profile
                TenantProfile::create([
                    'user_id' => $user->id,
                    'current_address' => $request->current_address,
                    'employment_status' => $request->employment_status,
                    'monthly_income' => $request->monthly_income,
                    'emergency_contact_name' => $request->emergency_contact_name,
                    'emergency_contact_phone' => $request->emergency_contact_phone,
                    'valid_id_type' => $request->valid_id_type,
                    'valid_id_front_path' => $validIdFrontPath,
                    'valid_id_back_path' => $validIdBackPath,
                ]);
            }

    
    
            // Trigger the Registered event
    
            event(new Registered($user));
    
    
            // Log the user in
    
            Auth::login($user);
    
    
            // Redirect to the dashboard

            return redirect()->route($request->role === 'owner' ? 'owner.dashboard' : 'listing.display'); // Redirect based on role
    
    
        } catch (Exception $e) {
    
            // Log the error or handle it as needed
    
            Log::error('Error in store method: ' . $e->getMessage());
    
    
            // Return a RedirectResponse with an error message
    
            return back()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
    
     
    
       }
    
}


    
}
