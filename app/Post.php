<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug'];

    public function category(){  // tabella secondaria, dipendente da posts
        return $this->belongsTo('App\Category'); // sapendo che e' la tabella secondaria ci andra' x forza ->belongsTo
    }
}
