<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'club_id',
        'title',
        'description',
        'date',
        'poster',
        'start_time',
        'end_time',
        'location',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    // public function guests()
    // {
    //     return $this->belongsToMany(Guest::class, 'event_guests');
    // }
    public function guests()
    {
        return $this->hasMany(EventGuest::class);
    }
}
