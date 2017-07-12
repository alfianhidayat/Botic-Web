<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $fillable = ['review','response','rating','id_object','id_menu','id_user','created_at','updated_at'];

    public function menu(){
        return $this->belongsTo(Menu::class, 'id_menu');
    }

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function tourism(){
        return $this->belongsTo(Tourism::class);
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    public function culinary(){
        return $this->belongsTo(Culinary::class,'id_object');
    }

    public function shopping(){
        return $this->belongsTo(Shopping::class,'id_object');
    }

    public function praying(){
        return $this->belongsTo(Praying::class,'id_object');
    }

    public function transportation(){
        return $this->belongsTo(Transportation::class,'id_object');
    }

    public function publicService(){
        return $this->belongsTo(PublicService::class,'id_object');
    }

    public function finance(){
        return $this->belongsTo(Finance::class,'id_object');
    }

    public function leisure(){
        return $this->belongsTo(Leisure::class,'id_object');
    }

    public function health(){
        return $this->belongsTo(Health::class,'id_object');
    }

    public function event(){
        return $this->belongsTo(Event::class,'id_object');
    }

}
