<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public function hasPermission($permission)
    {
        if (session()->has('role') && in_array($permission, json_decode(session('role.permissions')))) {
            return true;
        }
        return false;
    }

    public function access()
    {
        return $this->hasOne(Access::class);
    }

    public function landlord()
    {
        return $this->hasOne(Landlord::class);
    }

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function properties()
    {
        return $this->hasManyThrough(Property::class, Landlord::class);
    }

    public function tenants()
    {
        $propertyIds = $this->properties->pluck('id');
        return Resident::whereIn('property_id', $propertyIds)->get();
    }

    public function dues()
    {
        if($this->landlord && $this->residents->isNotEmpty()) {
          return \App\Due::where('payer', 'residentLandlord')->orWhere('payer', 'allLandlord')->get();
        }elseif ($this->landlord && $this->residents->isEmpty()) {
          return \App\Due::where('payer', 'allLandlord')->get();
        }elseif($this->residents->isNotEmpty() && !$this->landlord){
          return \App\Due::where('payer', 'resident')->get();
        }

        return false;
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
        return $this->hasMany(Staff::class, 'host_id');
    }

    public function paymentStatus()
    {
        return $this->hasMany(PaymentStatus::class);
    }

    public function estate()
    {
        return $this->belongsToMany('App\Estate');
    }

}
