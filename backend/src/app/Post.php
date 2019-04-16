<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'thread_id',
        'link_id',
        'user_id', 
        'parent_link_id', 
        'text', 
        'rating'
    ];

    public function getRouteKeyName()
    {
        return 'link_id';
    }

    public function thread()
    {
        return $this->belongsTo('App\Thread', 'thread_link_id');
    }

    public function replies()
    {
        return $this->hasMany('App\Post', 'parent_link_id')->with('replies');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function files()
    {
        return $this->morphToMany('App\File', 'attachable');
    }
}
