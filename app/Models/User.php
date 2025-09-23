<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\enum\roles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = "user";
    protected $primaryKey = "id";
    protected $fillable = [
        'role_id',
        'firstName',
        'lastName',
        'email',
        'password',
        'contact',
        'gender',
        'address',
        'country',
        'profile'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'role_id' => roles::class
        ];
    }

    protected function getFullNameAttribute()
    {
        return ucfirst($this->firstName) . " " . ucfirst($this->lastName);
    }
    protected function getRoleNameAttribute()
    {
        return ucfirst($this->role_id->name);
    }

    public function countryData()
    {
        return $this->hasOne(country::class, 'id','country');
    }
}
