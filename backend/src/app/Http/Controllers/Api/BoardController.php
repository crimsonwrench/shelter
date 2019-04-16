<?php

namespace App\Http\Controllers\Api;

use App\Services\BoardService;
use App\Board;

class BoardController extends Controller
{
    protected $boardService;

    public function __construct(BoardService $boardService)
    {
        $this->boardService = $boardService;
    }

    public function index()
    {
        return $this->boardService->index();
    }

    public function show(Board $board)
    {
        return $this->boardService->show($board);
    }
}