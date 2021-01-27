<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts(){  // posts al plurale perche' una category puo' avere piu' posts collegati ad essa
        return $this->hasMany('App\Post'); //Category ha tanti post associati quindi avra' la relazione hasMany che la mappera' con App\Post
    }
}
