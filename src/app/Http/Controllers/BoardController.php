<?php

namespace App\Http\Controllers;

use App\Board;
use App\Services\BoardService;
use App\Services\AccessService;

class BoardController extends Controller
{
    protected $boardService;
    protected $accessService;

    public function __construct(BoardService $boardService, AccessService $accessService)
    {
        $this->boardService = $boardService;
        $this->accessService = $accessService;
    }

    public function showBoard($boardName)
    {
        $board = Board::where('name_short', $boardName)->firstOrFail();

        $threads = $this->boardService->loadThreads($board);

        return view('board.board', ['threads' => $threads, 'board' => $board, 'roles' => $this->accessService->checkRoles()]);
    }

    public function index()
    {
        $boards = Board::all();

        return view('board.index', ['boards' => $boards]);
    }
}
