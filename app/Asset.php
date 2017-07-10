<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public function booking(){
        return $this->hasMany(Booking::class,'id_object');
    }
}
