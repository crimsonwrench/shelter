<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    public function board()
    {
        return $this->belongsTo('App\Board');
    }

    public function getAllPosts()
    {
        return DB::table('posts')
            ->where('belongs_to', $this->id)
            ->orderBy('num')
            ->orderBy('created_at')
            ->get();
    }

    public function getLastPosts($quantity = 3)
    {
        return DB::table('posts')
            ->where('belongs_to', $this->id)
            ->orderByDesc('num')
            ->orderByDesc('created_at')
            ->limit($quantity)
            ->get()
            ->reverse();
    }
}
