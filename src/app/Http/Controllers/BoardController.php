<?php

namespace App\Http\Controllers;

use App\Board;
use App\Services\BoardService;
use Illuminate\Support\Facades\App;

class BoardController extends Controller
{
    protected $board_service;

    public function __construct(BoardService $board_service)
    {
        $this->board_service = $board_service;
    }

    public function showBoard($board_name)
    {
        $board = Board::where('name_short', $board_name)->firstOrFail();

        $threads = $this->board_service->loadThreads($board);

        return view('board.board', ['threads' => $threads, 'board' => $board]);
    }

    public function index()
    {
        $boards = Board::all();

        return view('board.index', ['boards' => $boards]);
    }
}
