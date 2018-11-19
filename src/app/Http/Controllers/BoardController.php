<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Support\Facades\App;

class BoardController extends Controller
{
    public function showBoard($boardname)
    {
        $board = Board::where('name_short', $boardname)->first();

        $threads = $board->threads()->get();

        return view('board.board', ['threads' => $threads, 'board' => $board]);
    }

    public function index()
    {
        $boards = DB::table('boards')->get();

        return view('board.index', ['boards' => $boards]);
    }
}
