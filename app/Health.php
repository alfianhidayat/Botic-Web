<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    public function review(){
        return $this->hasMany(Review::class,'id_object');
    }
}
