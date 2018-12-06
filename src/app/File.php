<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['hash', 'name', 'extension', 'type', 'size'];

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
