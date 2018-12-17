<?php

namespace App\Http\Controllers;

use Auth;
use App\Board;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Services\AccessService;
use App\Http\Requests\StorePost;
use App\Http\Requests\StoreThread;

class PostController extends Controller
{
    protected $postService;
    protected $accessService;
 
    public function __construct(PostService $postService, AccessService $accessService)
    {
        $this->postService = $postService;
        $this->accessService = $accessService;
    }
 
    public function showThread($boardName, $threadNum)
    {
        $board = Board::where('name_short', $boardName)->firstOrFail();
        $thread = $board->posts()
            ->with('user', 'activeChildren.user', 'activeChildren', 'files', 'activeChildren.files')
            ->where('num', $threadNum)
            ->where('status', '!=', 'archived')
            ->where('is_op', 1)
            ->firstOrFail();
 
        return view('board.thread.thread', ['board' => $board, 'thread' => $thread, 'roles' => $this->accessService->checkRoles()]);
    }
 
    public function storeThread(StoreThread $request, $boardName)
    {
        $newThread = $this->postService->storeThread($request, $boardName);
        return redirect()->route('threads.show', [$boardName, $newThread->num]);
    }

    public function delete($boardName, $num)
    {
        $this->postService->delete($boardName, $num);
        return redirect()->back();
    }
 
    public function storePost(StorePost $request, $boardName, $threadNum)
    {
        $this->postService->storePost($request, $boardName, $threadNum);
        return redirect()->route('threads.show', [$boardName, $threadNum]);
    }

}
