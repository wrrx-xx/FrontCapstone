<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'email',
        'password',
        'phone_number',     
        'role',
        'owner_id',
        'profile_photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship to owner (if user is a caretaker)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Relationship to caretakers (if user is an owner)
    public function caretakers()
    {
        return $this->hasMany(User::class, 'owner_id')->where('role', 'caretaker');
    }
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function listing(){
        return $this->hasMany(Listing::class, 'owner_id');
    }
    public function verify(){
        return $this->hasMany(Verification::class);
    }
    public function viewing(){
        return $this->hasMany(Viewing::class,'requested_by');
        }
    public function reservation(){
        return $this->hasMany(Reservation::class,'prospect_id');
            }
    public function support(){
        return $this->hasMany(Support::class,'requested_by');

    }
    public function suppmess(){
        return $this->hasMany(SupportMessages::class,'sender_id');

    }
    public function mess(){
        return $this->hasMany(Messages::class,'sender_id');

    }

    public function billings()
    {
        return $this->hasMany(Billings::class, 'user_id');
    }

    public function tenant(){
        return $this->hasOne(listing::class,'tenant_id');
    }
    public function tenantProfile()
    {
        return $this->hasOne(TenantProfile::class, 'user_id');
    }
    public function ownerProfile()
    {   
        return $this->hasOne(OwnerProfile::class, 'user_id');
    }
    public function processed()
    {
        return $this->hasMany(Payment::class, 'processed_by');
    }
    public function request(){
        return $this->hasMany(MaintenanceRequest::class, 'tenant_id');
    }
    public function isAdmin(){
        return $this->role=='admin';
    }
    public function isOwner(){
        return $this->role=='owner';
    }
    public function isTenant(){
        return $this->role=='tenant';
    }

    public function isCaretaker(){
        return $this->role=='caretaker';
    }
    public function isGuest(){
        return $this->role=='guest';
    }
   
}
