<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    // public function events()
    // {
    //     return $this->belongsToMany(Event::class, 'event_guests');
    // }
    public function events()
    {
        return $this->hasMany(EventGuest::class);
    }
}
