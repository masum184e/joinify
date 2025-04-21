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
        'role',
        'password',
        'profile_picture',
    ];

    // 🔐 Hide sensitive fields
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 🧠 Cast data types
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    // 🔁 Relationships
    public function clubRoles()
    {
        return $this->hasMany(ClubUserRole::class);
    }
    // public function member()
    // {
    //     return $this->hasOne(Member::class);
    // }

    // public function clubsAsPresident()
    // {
    //     return $this->hasMany(Club::class, 'president_id');
    // }

    // public function clubsAsSecretary()
    // {
    //     return $this->hasMany(Club::class, 'secretary_id');
    // }

    // public function clubsAsAccountant()
    // {
    //     return $this->hasMany(Club::class, 'accountant_id');
    // }
}
