<?php

namespace App\Http\Controllers;

use Auth;
use App\Board;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\StorePost;
use App\Http\Requests\StoreThread;

class PostController extends Controller
{
    protected $post_service;
 
    public function __construct(PostService $post_service)
    {
        $this->post_service = $post_service;
    }
 
    public function showThread($board_name, $thread_num)
    {
        $board = Board::where('name_short', $board_name)->firstOrFail();
        $thread = $board->posts()
            ->with('user', 'files', 'children.files', 'children')
            ->where('num', $thread_num)
            ->where('status', '!=', 'archived')
            ->where('is_op', 1)
            ->firstOrFail();
 
        return view('board.thread.thread', ['board' => $board, 'thread' => $thread]);
    }
 
    public function storeThread(StoreThread $request, $board_name)
    {
        $new_thread = $this->post_service->storeThread($request, $board_name);
        return redirect()->route('threads.show', [$board_name, $new_thread->num]);
    }
 
    public function storePost(StorePost $request, $board_name, $thread_num)
    {
        $this->post_service->storePost($request, $board_name, $thread_num);
        return redirect()->route('threads.show', [$board_name, $thread_num]);
    }
}
