<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $fillable = [
        'member_id','amount','total','current'
    ];

    public function member(){
        return $this->belongsTo(Member::class);
    }
}