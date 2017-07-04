<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    public function visitor(){
        return $this->hasMany(Visitor::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
