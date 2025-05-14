<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
   public function update(ProfileUpdateRequest $request): RedirectResponse
{
    try {
        $user = $request->user();
        $validated = $request->validated();

        // Update user fields
        $user->fill([
            'fname' => $validated['fname'],
            'mname' => $validated['mname'] ?? $user->mname,
            'lname' => $validated['lname'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'profile_photo'=> $validated['profile_photo'],
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('profile_photos'), $fileName);
            $profilePhotoPath = 'profile_photos/' . $fileName;
        } else {
            $profilePhotoPath = $user->profile_photo ?? null;
        }
        $user->profile_photo = $profilePhotoPath;

        $user->save();

        // Update or create tenant profile if user is tenant or guest
        if ($user->isTenant() || $user->isGuest()) {
            $tenantProfileData = [
                'current_address' => $validated['current_address'] ?? null,
                'employment_status' => $validated['employment_status'] ?? null,
                'monthly_income' => $validated['monthly_income'] ?? null,
                'emergency_contact_name' => $validated['emergency_contact_name'] ?? null,
                'emergency_contact_phone' => $validated['emergency_contact_phone'] ?? null,
                'valid_id_type' => $validated['valid_id_type'] ?? null,
            ];

            // Handle valid ID front upload
            if ($request->hasFile('valid_id_front_path')) {
                $file = $request->file('valid_id_front_path');
                $tenantProfileData['valid_id_front_path'] = $file->store('tenant_ids/front', 'public');
            } else {
                $tenantProfileData['valid_id_front_path'] = $user->tenantProfile->valid_id_front_path ?? null;
            }

            // Handle valid ID back upload
            if ($request->hasFile('valid_id_back_path')) {
                $file = $request->file('valid_id_back_path');
                $tenantProfileData['valid_id_back_path'] = $file->store('tenant_ids/back', 'public');
            } else {
                $tenantProfileData['valid_id_back_path'] = $user->tenantProfile->valid_id_back_path ?? null;
            }

            $user->tenantProfile()->updateOrCreate(
                ['user_id' => $user->id],
                $tenantProfileData
            );
        }

        // Update or create owner profile if user is owner
        if ($user->isOwner()) {
            $ownerProfileData = array_filter([
                'business_name' => $validated['business_name'] ?? null,
                'business_address' => $validated['business_address'] ?? null,
                'business_phone' => $validated['business_phone'] ?? null,
                'business_email' => $validated['business_email'] ?? null,
                'owner_id_type' => $validated['owner_id_type'] ?? null,
                'additional_info' => $validated['additional_info'] ?? null,
            ]);

            // Handle owner ID front upload
            if ($request->hasFile('owner_id_front')) {
                $frontName = time() . '_front_' . $request->file('owner_id_front')->getClientOriginalName();
                $request->file('owner_id_front')->move(public_path('owner_ids/front'), $frontName);
                $ownerProfileData['owner_id_front_path'] = 'owner_ids/front/' . $frontName;
            } else {
                $ownerProfileData['owner_id_front_path'] = $user->ownerProfile->owner_id_front_path ?? null;
            }

            // Handle owner ID back upload
            if ($request->hasFile('owner_id_back')) {
                $backName = time() . '_back_' . $request->file('owner_id_back')->getClientOriginalName();
                $request->file('owner_id_back')->move(public_path('owner_ids/back'), $backName);
                $ownerProfileData['owner_id_back_path'] = 'owner_ids/back/' . $backName;
            } else {
                $ownerProfileData['owner_id_back_path'] = $user->ownerProfile->owner_id_back_path ?? null;
            }

            $user->ownerProfile()->updateOrCreate(
                ['user_id' => $user->id],
                $ownerProfileData
            );
        }

        // Handle password change
        if (!empty($validated['old_password']) && !empty($validated['new_password'])) {
            if (Hash::check($validated['old_password'], $user->password)) {
                $user->password = $validated['new_password'];
                $user->save();
            } else {
                return Redirect::route('profile.edit')->withErrors(['old_password' => 'Old password is incorrect']);
            }
        }

        return Redirect::route('profile.edit')->with('success', 'profile-updated');
    } catch (\Throwable $e) {
        // Log the error
        Log::error('Error updating profile', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);

        // Redirect with error message
        return Redirect::route('profile.edit')->withErrors(['error' => 'An error occurred while updating the profile. Please try again later.']);
    }
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
