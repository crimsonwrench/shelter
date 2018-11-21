<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    public function showBoard($boardname)
    {
        $board = Board::where('name_short', $boardname)->firstOrFail();

        $threads = $board->getThreads();

        return view('board.board', ['threads' => $threads, 'board' => $board]);
    }

    public function index()
    {
        $boards = Board::all();

        return view('board.index', ['boards' => $boards]);
    }
}
