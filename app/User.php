<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function videos(){
        return $this->hasMany('App\Video');
    }

    public function pages(){
        return $this->hasMany('App\Page');
    }
}
