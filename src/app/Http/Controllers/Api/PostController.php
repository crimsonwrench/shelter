<?php

namespace App\Http\Controllers\Api;

use App\Thread;
use App\Post;
use App\Http\Requests\StorePublication;
use App\Services\AccessService;
use App\Services\PostService;

class PostController extends Controller
{

    protected $postService;
    protected $accessService;

    public function __construct(PostService $postService, AccessService $accessService)
    {
        $this->postService = $postService;
        $this->accessService = $accessService;
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
