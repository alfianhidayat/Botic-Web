<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    public function coordinator(){
        return $this->belongsTo(Coordinator::class);
    }

    public function menu(){
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}
