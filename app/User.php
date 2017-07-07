<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','id_role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function review(){
        return $this->hasMany(Review::class,'id_user');
    }

    public function booking(){
        return $this->hasMany(Booking::class);
    }

    public function coordinator(){
        return $this->hasMany(Coordinator::class);
    }
}
