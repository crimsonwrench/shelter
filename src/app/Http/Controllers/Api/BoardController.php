<?php

namespace App\Http\Controllers\Api;

use App\Board;
use App\Http\Controllers\Controller;
use App\Services\BoardService;
use App\Http\Resources\Board as BoardResource;
use App\Http\Resources\Post as PostResource;


class BoardController extends Controller
{
    protected $boardService;

    public function __construct(BoardService $boardService)
    {
        $this->boardService = $boardService;
    }

    public function index()
    {
        return BoardResource::collection(Board::all());
    }

    public function threads($name)
    {
        $board = Board::where('name_short', $name)->firstOrFail();
        $threads = $this->boardService->loadThreads($board);

        return PostResource::collection($threads);
    }

    public function show($name)
    {
        $board = Board::where('name_short', $name)->firstOrFail();

        return new BoardResource($board);
    }
}