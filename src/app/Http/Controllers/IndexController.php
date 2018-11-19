<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function boards()
    {
        $boards = DB::table('boards')->get();

        return view('board.index', ['boards' => $boards]);
    }
}
