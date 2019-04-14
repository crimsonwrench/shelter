<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = [
        'link_id',
        'board_id',
        'user_id',
        'title',
        'text',
        'rating',
        'is_sticky',
        'status'
    ];

    public function getRouteKeyName()
    {
        return 'link_id';
    }

    public function board()
    {
        return $this->belongsTo('App\Board');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function allPosts()
    {
        return $this->hasMany('App\Post');
    }

    public function rootPosts()
    {
        return $this->hasMany('App\Post')->whereNull('parent_link_id')->with('user', 'files');
    }

    public function files()
    {
        return $this->morphToMany('App\File', 'attachable');
    }
}
