<?php

namespace App\Http\Controllers;

use Auth;
use App\Board;
use App\Post;
use App\User;
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
        $board = Board::where('name_short', $boardName)->firstOrFail();
        $board->last_post_num += 1;
        $board->save();

        $user = Auth::user();

        $newThread = $board->posts()->create([
            'num' => $board->last_post_num,
            'user_id' => $user->id,
            'is_op' => 1,
            'title' => $request->title,
            'text' => $request->text,
        ]);

        return redirect()->route('threads.show', [$board->name_short, $newThread->num]);
    }

    public function storePost(StorePost $request, $boardName, $threadNum)
    {

        $board = Board::where('name_short', $boardName)->firstOrFail();
        $board->last_post_num += 1;
        $board->save();

        $thread = $board->posts()->where('num', $threadNum)->where('is_op', 1)->firstOrFail();

        $user = Auth::user();

        $newPost = $board->posts()->create([
            'num' => $board->last_post_num,
            'user_id' => $user->id,
            'belongs_to' => $thread->id,
            'text' => $request->text,
        ]);
        // Updating thread's date
        $thread->updated_at = $newPost->created_at;
        $thread->save();

        return redirect()->route('threads.show', [$boardName, $threadNum]);
    }
}
