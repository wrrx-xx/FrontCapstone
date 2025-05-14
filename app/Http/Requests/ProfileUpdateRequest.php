<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'mobile_number' => ['nullable', 'string', 'max:20'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'skype' => ['nullable', 'string', 'max:255'],
            'language' => ['nullable', 'array'],
            'language.*' => ['string', 'max:255'],
            'profile_photo' => ['nullable', 'image', 'max:10058'], // max 2MB
            'old_password' => ['nullable', 'string', 'min:8'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
            // TenantProfile fields can be added here if needed
            'current_address' => ['nullable', 'string', 'max:255'],
            'employment_status' => ['nullable', 'string', 'max:255'],
            'monthly_income' => ['nullable', 'numeric'],
            'emergency_contact_name' => ['nullable', 'string', 'max:255'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:20'],
            'valid_id_type' => ['nullable', 'string', 'max:255'],
            'valid_id_front_path' => ['nullable', 'image', 'max:10048'],
            'valid_id_back_path' => ['nullable', 'image', 'max:10048'],
            // OwnerProfile fields validation added
            'business_name' => ['nullable', 'string', 'max:255'],
            'business_address' => ['nullable', 'string', 'max:255'],
            'business_phone' => ['nullable', 'string', 'max:20'],
            'business_email' => ['nullable', 'email', 'max:255'],
            'owner_id_type' => ['nullable', 'string', 'max:255'],
            'owner_id_front_path' => ['nullable', 'image', 'max:2048'],
            'owner_id_back_path' => ['nullable', 'image', 'max:2048'],
            'additional_info' => ['nullable', 'string'],
        ];
    }
}
