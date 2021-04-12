<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estate extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function streets()
    {
        return $this->hasMany(Street::class);
    }

    public function dues()
    {
        return $this->hasMany(Due::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }

    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }

    public function paymentStatuses()
    {
        return $this->hasMany(PaymentStatus::class);
    }

    public function setting()
    {
        return $this->hasOne(Setting::class);
    }
}
