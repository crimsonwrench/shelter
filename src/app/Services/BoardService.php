<?php

namespace App\Services;

use App\Board;
use App\Http\Resources\Board as BoardResource;
use App\Http\Resources\Thread as ThreadResource;

class BoardService
{    
    public function index()
    {
        return BoardResource::collection(Board::all());
    }

    public function show(Board $board)
    {
        $threads = $board->threads()
            ->with(['user', 'files'])
            ->withCount('allPosts')
            ->where('status', '!=', 'archived')
            ->take(10)
            ->get();

        return ThreadResource::collection($threads);
    }
}
