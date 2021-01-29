<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'category_id']; // campi compilabili in automatico in batch

    public function category(){  // tabella secondaria, dipendente da posts
        return $this->belongsTo('App\Category'); // sapendo che e' la tabella secondaria ci andra' x forza ->belongsTo
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
