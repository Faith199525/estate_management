<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;
    
    protected $with = ['estate'];

    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }
}
