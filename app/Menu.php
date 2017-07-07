<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $fillable = ['menu','icon' ];

    public function tourism()
    {
        return $this->hasMany(Tourism::class, 'id_menu');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'id_menu');
    }

    public function visitor()
    {
        return $this->hasMany(Visitor::class, 'id_menu');
    }

    public function coordinator()
    {
        return $this->hasMany(Coordinator::class, 'id_menu');
    }
}
