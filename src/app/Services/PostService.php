<?php

namespace App\Services;

use Auth;
use App\File;
use App\Board;
use App\Http\Requests\StorePost;
use App\Http\Requests\StoreThread;

class PostService
{
    public function storeThread(StoreThread $request, $boardName)
    {
        $board = Board::where('name_short', $boardName)->firstOrFail();
        $board->last_post_num += 1;
        $board->save();

        $threads = $board->posts()
            ->where(['board_id' => $board->id, 'is_op' => 1, ['status', '!=', 'archived']])
            ->orderByDesc('is_sticky')
            ->orderByDesc('updated_at')
            ->get();

        $user = Auth::user();

        $newThread = $board->posts()->create([
            'num' => $board->last_post_num,
            'user_id' => $user->id,
            'is_op' => 1,
            'title' => $request->title,
            'text' => $request->text,
        ]);

        if ($request->hasFile('filename')) {
            foreach ($request->file('filename') as $file) {
                $queryFile = File::where('hash', sha1_file($file))->firstOrFail();
                $newThread->files()->attach($queryFile);
            }
        }

        // Archiving the last sinking thread if there are more too many active threads (default: 10)

        if($threads->count() > env('SHELTER_THREADS_ON_PAGE', 10) && $threads->last()->status == 'sinking') {
            $threads->last()->status = 'archived';
            $threads->last()->save();
        }

        return $newThread;
    }

    public function delete($boardName, $postNum) 
    {
        $board = Board::where('name_short', $boardName)->firstOrFail();
        $post = $board->posts()->where('num', $postNum)->firstOrFail();

        $post->status = 'archived';
        $post->save();
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


        if ($request->hasFile('filename')) {
            foreach ($request->file('filename') as $file) {
                $queryFile = File::where('hash', sha1_file($file))->firstOrFail();
                $newPost->files()->attach($queryFile);
            }
        }

        // Bumping thread until it reaches post limit (default: 500)

        if ($thread->activeChildren()->get()->count() < env('SHELTER_BUMP_LIMIT', 500) && $thread->status == 'active') {
            if (!$newPost->is_sage)
                $thread->updated_at = $newPost->created_at;
        } else {
            $thread->status = 'sinking';
        }

        $thread->save();
    }
}
