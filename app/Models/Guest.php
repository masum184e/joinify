<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guest extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'email'];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_guests');
    }
}
