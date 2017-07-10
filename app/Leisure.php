<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leisure extends Model
{
    public $fillable = ['name','address','phone','description','price','open','close','id_category'];
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
