<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'membership_id', 'payment_status', 'paid_at', 'transaction_id', 'amount'
    ];

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
}
