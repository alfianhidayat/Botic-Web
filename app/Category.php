<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
//    public function hotel(){
//        return $this->hasMany(Hotel::class);
//    }
    public function tourism()
    {
        return $this->hasMany(Tourism::class, 'id_category');
    }

    public function hotel()
    {
        return $this->hasMany(Hotel::class, 'id_category');
    }

    public function shopping()
    {
        return $this->hasMany(Shopping::class, 'id_category');
    }

    public function culinary()
    {
        return $this->hasMany(Culinary::class, 'id_category');
    }

    public function transportation()
    {
        return $this->hasMany(Transportation::class, 'id_category');
    }
}
