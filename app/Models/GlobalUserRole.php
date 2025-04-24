<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GlobalUserRole extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id', 'role',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
