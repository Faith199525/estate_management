<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'landlord_id', 'street_id', 'house_no', 'address',
    ];

    protected $dates = ['deleted_at'];

    public function landlord()
    {
        return $this->belongsTo(Landlord::class);
    }

    public function street()
    {
        return $this->belongsTo(Street::class);
    }

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }

    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }

}
