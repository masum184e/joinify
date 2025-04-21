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
}
