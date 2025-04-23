<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membership extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'member_id', 'club_id'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
