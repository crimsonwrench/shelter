<?php

namespace App\Http\Controllers;

use App\Board;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use App\Http\Requests\StoreThread;

class PostController extends Controller
{
    public function showThread($boardName, $threadNum)
    {
        $board = Board::where('name_short', $boardName)->firstOrFail();

        $thread = $board->posts()->where('num', $threadNum)->where('is_op', 1)->firstOrFail();

        $posts = $thread->getAllPosts();

        return view('board.thread.thread', ['board' => $board, 'thread' => $thread, 'posts' => $posts]);
    }

    public function storeThread(StoreThread $request, $boardName)
    {

        $newThread = new Post();

        $board = Board::where('name_short', $boardName)->firstOrFail();

        $board->last_post_num += 1;

        $newThread->title = $request->title;
        $newThread->text = $request->text;
        $newThread->num = $board->last_post_num;
        $newThread->poster_ip = $request->ip();
        $newThread->is_op = 1;

        $board->save();
        $board->posts()->save($newThread);

        return redirect()->route('threads.show', [$board->name_short, $newThread->num]);
    }

    public function storePost(StorePost $request, $boardName, $threadNum)
    {
        $newPost = new Post();

        $board = Board::where('name_short', $boardName)->firstOrFail();
        $board->last_post_num += 1;

        $thread = $board->posts()->where('num', $threadNum)->where('is_op', 1)->firstOrFail();

        $post->belongs_to = $thread->id;
        $post->text = $request->text;
        $post->num = $board->last_post_num;
        $post->poster_ip = $request->ip();

        $board->save();
        $board->posts()->save($post);

        // Updating thread's date
        $thread->updated_at = $post->created_at;
        $thread->save();

        return redirect()->route('threads.show', [$boardName, $threadNum]);
    }
}
