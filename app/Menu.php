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
}
