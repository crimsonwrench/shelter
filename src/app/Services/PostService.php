<?php

namespace App\Services;

use Auth;
use App\Post;
use App\Board;
use App\Http\Requests\StorePost;
use App\Http\Requests\StoreThread;

class PostService
{

    public function storeThread(StoreThread $request, $board_name)
    {
        $board = Board::where('name_short', $board_name)->firstOrFail();
        $board->last_post_num += 1;
        $board->save();

        $threads = $board->getThreads();

        $user = Auth::user();

        $new_thread = $board->posts()->create([
            'num' => $board->last_post_num,
            'user_id' => $user->id,
            'is_op' => 1,
            'title' => $request->title,
            'text' => $request->text,
        ]);

        // Archiving the last sinking thread if there are more than 10 active threads

        if($threads->count() > 10 && $threads->last()->status == 'sinking') {
            $threads->last()->status = 'archived';
            $threads->last()->save();
        }

        return $new_thread;
    }

    public function storePost(StorePost $request, $board_name, $thread_num)
    {
        $board = Board::where('name_short', $board_name)->firstOrFail();
        $board->last_post_num += 1;
        $board->save();

        $thread = $board->posts()->where('num', $thread_num)->where('is_op', 1)->firstOrFail();

        $user = Auth::user();

        $new_post = $board->posts()->create([
            'num' => $board->last_post_num,
            'user_id' => $user->id,
            'belongs_to' => $thread->id,
            'text' => $request->text,
        ]);

        // Bumping thread if it has less than 500 posts;

        if ($thread->getAllPosts()->count() < 500 && $thread->status == 'active') {
            $thread->updated_at = $new_post->created_at;
        } else {
            $thread->status = 'sinking';
        }

        $thread->save();
    }
}
