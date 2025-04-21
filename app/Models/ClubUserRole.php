<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClubUserRole extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'club_id',
        'user_id',
        'role',
        'verified',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
