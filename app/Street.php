<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Street extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }
}
