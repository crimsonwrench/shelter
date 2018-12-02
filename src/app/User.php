<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    
    protected $fillable = ['name', 'email','remember_token'];

    protected $hidden = ['remember_token'];

    public $timestamps = false;

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}