<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    public $fillable = ['role_name'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
