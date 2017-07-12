<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    protected $fillable = ['user_id', 'visitor_number', 'phone' ,'id_menu'];

    public function visitor(){
        return $this->hasMany(Visitor::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function menu(){
        return $this->belongsTo(Menu::class,'id_menu');
    }
}
