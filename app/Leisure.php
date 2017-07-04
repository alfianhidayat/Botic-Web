<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leisure extends Model
{
    public $fillable = ['name','address','phone','description','price','open','close','id_category'];
}
