<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Praying extends Model
{
    public function review(){
        return $this->hasMany(Review::class,'id_object');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}
