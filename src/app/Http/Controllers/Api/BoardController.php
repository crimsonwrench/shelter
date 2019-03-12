<?php

namespace App\Http\Controllers\Api;

use App\Board;
use App\Http\Controllers\Controller;
use App\Http\Resources\Board as BoardResource;

class BoardController extends Controller
{
    public function index()
    {
        return BoardResource::collection(Board::all());
    }

    public function show($name)
    {
        $board = Board::where('name_short', $name)->firstOrFail();

        return new BoardResource($board);
    }
}