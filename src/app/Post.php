<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['num', 'user_id', 'is_op', 'belongs_to', 'title', 'text', 'is_sage', 'is_sticky'];

    public function board()
    {
        return $this->belongsTo('App\Board');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function parent()
    {
        return $this->belongsTo('App\Post', 'belongs_to');
    }

    public function children()
    {
        return $this->hasMany('App\Post', 'belongs_to');
    }

    public function activeChildren()
    {
        return $this->children()->where('status', '!=', 'archived');
    }

    public function files()
    {
        return $this->belongsToMany('App\File');
    }
}
