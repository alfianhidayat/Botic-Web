<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Culinary extends Model
{
    //
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}
