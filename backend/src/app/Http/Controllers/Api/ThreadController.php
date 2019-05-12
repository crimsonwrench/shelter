<?php

namespace App\Http\Controllers\Api;

use App\Board;
use App\Thread;
use App\Services\ThreadService;
use App\Http\Requests\StorePublication;

class ThreadController extends Controller
{

    protected $threadService;

    public function __construct(ThreadService $threadService)
    {
        $this->threadService = $threadService;
    }

    public function show(Board $board, int $threadLink)
    {
        return $this->threadService->show($board, $threadLink);
    }

    public function store(StorePublication $request, Board $board)
    {
       $this->threadService->store($request, $board);
    }

    public function delete(Thread $thread)
    {
        $this->threadService->delete($thread);
    }
}
