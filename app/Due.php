<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Due extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function paymentStatus()
    {
        return $this->hasMany(PaymentStatus::class);
    }

    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }
}
