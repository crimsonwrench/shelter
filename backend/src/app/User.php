<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, Notifiable;
    
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

    public function findForPassport($username)
    {
        return $this->where('name', $username)->first();
    }
}