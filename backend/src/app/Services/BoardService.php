<?php

namespace App\Services;

use App\Board;
use App\Http\Resources\Board as BoardResource;
use App\Http\Resources\Thread as ThreadResource;
use Illuminate\Http\Request;

class BoardService
{
    public function index()
    {
        return BoardResource::collection(Board::all());
    }

    public function show(Board $board)
    {
        return new BoardResource($board);
    }

    public function showThreads(Board $board)
    {
        $threads = $board->threads()
            ->with(['user', 'files'])
            ->withCount('allPosts')
            ->where('status', '!=', 'archived')
            ->take(env('SHELTER_THREADS_ON_PAGE'))
            ->get();

        return ThreadResource::collection($threads);
    }

    public function store(Request $request)
    {
        return Board::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
    }
}
