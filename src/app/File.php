<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'hash', 
        'name', 
        'extension', 
        'type', 
        'size'
    ];

    public function posts()
    {
        return $this->morphedByMany('App\Post', 'publication');
    }

    public function threads()
    {
        return $this->morphedByMany('App\Thread', 'publication');
    }
}
