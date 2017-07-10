<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    public function booking(){
        return $this->hasMany(Booking::class,'id_time');
    }
}
