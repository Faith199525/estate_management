<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TijsVerkoyen\CssToInlineStyles\Css\Property\Property;

class Invite extends Model
{
    protected $fillable = [
        'email', 'token', 'property_id',
    ];

    // public function inviteable()
    // {
    //     return $this->morphTo();
    // }


    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }

}
