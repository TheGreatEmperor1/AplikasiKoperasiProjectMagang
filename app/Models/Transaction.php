<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'total','payment_type','member_id'
    ];

    // Tambahan: relasi ke member
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
