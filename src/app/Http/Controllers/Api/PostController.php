<?php

namespace App\Http\Controllers\Api;

use App\Board;
use App\Services\PostService;
use App\Services\AccessService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePost;
use App\Http\Requests\StoreThread;
use App\Http\Resources\Post as PostResource;

class PostController extends Controller
{

    protected $postService;
    protected $accessService;
 
    public function __construct(PostService $postService, AccessService $accessService)
    {
        $this->postService = $postService;
        $this->accessService = $accessService;
    }

    public function storeThread(StoreThread $request, $boardName)
    {
       $this->postService->storeThread($request, $boardName);
    }

    public function storePost(StorePost $request, $boardName, $threadNumber)
    {
        $this->postService->storePost($request, $boardName, $threadNumber);
    }

    public function showThread($board, $threadNumber)
    {
        $board = Board::where('name_short', $board)->firstOrFail();
        $thread = $board->posts()
            ->with('user', 'activeChildren.user', 'activeChildren', 'files', 'activeChildren.files')
            ->where('num', $threadNumber)
            ->where('status', '!=', 'archived')
            ->where('is_op', 1)
            ->firstOrFail();

        return new PostResource($thread);

    }
    public function showPost($board, $postNumber)
    {
        $board = Board::where('name_short', $board)->firstOrFail();
        $post = $board->posts()
            ->with('user', 'files')
            ->where('num', $postNumber)
            ->where('status', '!=', 'archived')
            ->firstOrFail();

        return new PostResource($post);

    }
}
