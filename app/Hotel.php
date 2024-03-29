<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
    public function review(){
        return $this->hasMany(Review::class,'id_object');
    }
}
