<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'email',
        'phone_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
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
}
