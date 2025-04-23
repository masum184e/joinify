<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Club extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function userRoles()
    {
        return $this->hasMany(ClubUserRole::class);
    }

    public function president()
    {
        return $this->hasOne(ClubUserRole::class)->where('role', 'president')->with('user');
    }

    public function secretary()
    {
        return $this->hasOne(ClubUserRole::class)->where('role', 'secretary')->with('user');
    }

    public function accountant()
    {
        return $this->hasOne(ClubUserRole::class)->where('role', 'accountant')->with('user');
    }

    public function events()
{
    return $this->hasMany(Event::class);
}

}
