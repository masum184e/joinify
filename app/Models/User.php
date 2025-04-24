<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // ⚙️ If your table name is not 'users', uncomment below
    // protected $table = 'users';

    // 🛡️ Mass assignable fields
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
    ];

    // 🔐 Hide sensitive fields
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 🔁 Relationships
    public function clubRoles()
    {
        return $this->hasMany(ClubUserRole::class);
    }

    // public function memberships()
    // {
    //     return $this->hasMany(Membership::class);
    // }

    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
    public function member()
    {
        return $this->hasOne(Member::class);
    }
    // public function club()
    // {
    //     return $this->belongsTo(Club::class);
    // }
    public function clubUserRoles()
    {
        return $this->hasMany(ClubUserRole::class);
    }
    // public function clubMemberships()
    // {
    //     return $this->hasMany(Membership::class);
    // }
    // public function clubMembership()
    // {
    //     return $this->hasMany(Membership::class);
    // }
    // public function clubUser()
    // {
    //     return $this->hasMany(Membership::class);
    // }

}
