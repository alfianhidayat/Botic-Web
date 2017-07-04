<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdentityType extends Model
{
    public function booking(){
        return $this->hasMany(Booking::class);
    }
}
