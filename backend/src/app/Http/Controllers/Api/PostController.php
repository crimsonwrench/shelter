<?php

namespace App\Http\Controllers\Api;

use App\Thread;
use App\Post;
use App\Http\Requests\StorePublication;
use App\Services\PostService;

class PostController extends Controller
{

    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function store(StorePublication $request, Thread $thread)
    {
        $this->postService->store($request, $thread);
    }

    public function delete(Post $post)
    {
        $this->postService->delete($post);
    }
}
