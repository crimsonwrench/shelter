<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function getAllPosts()
    {
        return Post::with('user')
            ->where('belongs_to', $this->id)
            ->orderBy('num')
            ->orderBy('created_at')
            ->get();
    }

    public function getLastPosts($quantity = 3)
    {
        return Post::with('user')
            ->where('belongs_to', $this->id)
            ->orderByDesc('num')
            ->orderByDesc('created_at')
            ->limit($quantity)
            ->get()
            ->reverse();
    }
}
