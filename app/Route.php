<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public function roles(){
        return $this->belongsToMany('App\Role');
    }
}
