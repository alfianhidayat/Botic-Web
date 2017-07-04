<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function identityType(){
        return $this->belongsTo(IdentityType::class);
    }
    public function bookingStatus(){
        return $this->belongsTo(BookingStatus::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function asset(){
        return $this->belongsTo(Asset::class,'id_object');
    }

    public function culture(){
        return $this->belongsTo(Culture::class,'id_object');
    }
}
