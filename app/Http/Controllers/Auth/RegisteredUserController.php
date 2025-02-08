<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TenantProfile;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

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
    
            $request->validate([
    
                'fname' => 'required|string|max:255',
    
                'mname' => 'nullable|string|max:255',
    
                'lname' => 'required|string|max:255',
    
                'email' => 'required|string|lowercase|email|max:255|unique:users',
    
                'phone_number' => 'required|string|max:20',

                'password' => ['required', 'confirmed', Rules\Password::defaults()],
    
                'current_address' => 'nullable|string|max:255',
    
                'employment_status' => 'nullable|string|max:255',
    
                'monthly_income' => 'nullable|numeric',
    
                'emergency_contact_name' => 'nullable|string|max:255',
    
                'emergency_contact_phone' => 'nullable|string|max:20',
    
                'valid_id_type' => 'nullable|string|max:255',
    
                'valid_id_front' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    
                'valid_id_back' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    
            ]);
    
    
            // Create the user
    
            $user = User::create([
    
                'fname' => $request->fname,
    
                'mname' => $request->mname,
    
                'lname' => $request->lname,
    
                'email' => $request->email,
    
                'phone_number' => $request->phone_number,
    
                'password' => Hash::make($request->password),
    
            ]);
    
    
            // Handle ID file uploads
    
            $validIdFrontPath = null;
    
            $validIdBackPath = null;
    
    
            if ($request->hasFile('valid_id_front')) {
    
                $validIdFrontPath = $request->file('valid_id_front')->store('tenant_ids/front', 'public');
    
            }
    
    
            if ($request->hasFile('valid_id_back')) {
    
                $validIdBackPath = $request->file('valid_id_back')->store('tenant_ids/back', 'public');
    
            }
    
    
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
    
    
            // Trigger the Registered event
    
            event(new Registered($user));
    
    
            // Log the user in
    
            Auth::login($user);
    
    
            // Redirect to the dashboard
    
            return redirect()->route('/'); // Ensure this returns a RedirectResponse
    
    
        } catch (Exception $e) {
    
            // Log the error or handle it as needed
    
            Log::error('Error in store method: ' . $e->getMessage());
    
    
            // Return a RedirectResponse with an error message
    
            return back()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
    
     
    
       }
    
}


    
}
