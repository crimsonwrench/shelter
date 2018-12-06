<?php

namespace App\Services;

use Auth;
use App\File;
use App\Post;
use App\Board;
use App\Services\BoardService;
use App\Http\Requests\StorePost;
use App\Http\Requests\StoreThread;
use Illuminate\Support\Facades\Storage;

class PostService
{

    public function storeThread(StoreThread $request, $board_name)
    {
        $board = Board::where('name_short', $board_name)->firstOrFail();
        $board->last_post_num += 1;
        $board->save();

        $threads = $board->posts()
            ->where(['board_id' => $board->id, 'is_op' => 1, ['status', '!=', 'archived']])
            ->orderByDesc('is_sticky')
            ->orderByDesc('updated_at')
            ->get();

        $user = Auth::user();

        $new_thread = $board->posts()->create([
            'num' => $board->last_post_num,
            'user_id' => $user->id,
            'is_op' => 1,
            'title' => $request->title,
            'text' => $request->text,
        ]);

        if ($request->hasFile('filename')) {
            
            foreach ($request->file('filename') as $file) {
                
                $query_file = File::where('hash', sha1_file($file))->first();

                if(!$query_file) {
                    $new_file = $new_thread->files()->create([
                        'hash' => sha1_file($file),
                        'name' => $file->getClientOriginalName(),
                        'extension' => $file->getClientOriginalExtension(),
                        'type' => $file->getClientMimeType(),
                        'size' => $file->getClientSize(),
                    ]);
                    Storage::disk('public_uploads')->putFileAs('img', $file, $file->getClientOriginalName());
                } else {
                    $new_thread->files()->attach($query_file);
                }
            }
        }

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


        if ($request->hasFile('filename')) {
            
            foreach ($request->file('filename') as $file) {
                $query_file = File::where('hash', sha1_file($file))->first();

                if(!$query_file) {
                    $new_file = $new_post->files()->create([
                        'hash' => sha1_file($file),
                        'name' => $file->getClientOriginalName(),
                        'extension' => $file->getClientOriginalExtension(),
                        'type' => $file->getClientMimeType(),
                        'size' => $file->getClientSize(),
                    ]);
                    Storage::disk('public_uploads')->putFileAs('img', $file, $file->getClientOriginalName());
                } else {
                    $new_post->files()->attach($query_file);
                }
            }
        }

        // Bumping thread if it has less than 500 posts;

        if ($thread->children()->get()->count() < 500 && $thread->status == 'active') {
            $thread->updated_at = $new_post->created_at;
        } else {
            $thread->status = 'sinking';
        }

        $thread->save();
    }
}
