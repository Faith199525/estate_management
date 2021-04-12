<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;

    public function host()
    {
        return $this->belongsTo(User::class, 'id', 'host_id');
    }

    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }
}
