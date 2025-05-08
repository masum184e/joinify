<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id', 'student_id', 'phone', 'department', 'reason'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }
}
