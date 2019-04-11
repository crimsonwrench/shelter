<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = ['name', 'name_short'];

    public $timestamps = false;

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
