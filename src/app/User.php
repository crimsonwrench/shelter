<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    
    protected $fillable = [
        'name', 
        'email',
        'email_verified_at',
        'password',
    ];

    protected $hidden = [
        'password','remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function threads()
    {
        return $this->hasMany('App\Thread');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasRole($role_name)
    {
        return $this->roles()->where('role_name', $role_name)->exists();
    }
}