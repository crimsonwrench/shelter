<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    public $timestamps = false;

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function threads()
    {
        return $this->posts()->where('is_op', 1);
    }
}
