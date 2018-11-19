<?php

namespace App\Http\Controllers;

use App\Board;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showThread($boardName, $threadNum)
    {
        $board = Board::where('name_short', $boardName)->first();

        $thread = $board->posts()->where('num', $threadNum)->first();

        $posts = $thread->getPosts();

        return view('board.thread.thread', ['board' => $board, 'thread' => $thread, 'posts' => $posts]);
    }

    public function storeThread(Request $request, $boardName)
    {
        $thread = new Post();

        $board = Board::where('name_short', $boardName)->first();

        $board->last_post_num += 1;

        $thread->title = $request->title;
        $thread->text = $request->text;
        $thread->num = $board->last_post_num;
        $thread->poster_ip = $request->ip();
        $thread->is_op = 1;

        $board->save();
        $board->posts()->save($thread);

        return redirect()->route('threads.show', [$board->name_short, $thread->num]);
    }

    public function storePost(Request $request, $boardName, $threadNum)
    {
        $post = new Post();

        $board = Board::where('name_short', $boardName)->first();

        $thread = $board->posts()->where('num', $threadNum)->first();

        $board->last_post_num += 1;

        $post->belongs_to = $thread->id;
        $post->text = $request->text;
        $post->num = $board->last_post_num;
        $post->poster_ip = $request->ip();

        $board->save();
        $board->posts()->save($post);

        return redirect()->route('threads.show', [$boardName, $threadNum]);
    }
}
