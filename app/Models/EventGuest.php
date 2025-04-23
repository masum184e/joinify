<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventGuest extends Model
{
    //
    use HasFactory;

    protected $table = 'event_guests';

    public $timestamps = false;

    protected $fillable = [
        'event_id',
        'guest_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
