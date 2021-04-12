<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['deleted_at'];

    public function due()
    {
        return $this->belongsTo(Due::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function paymentable()
    // {
    //     return $this->morphTo();
    // }

    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }
}
