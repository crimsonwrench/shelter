<?php

namespace App\Services;

use Auth;
use App\File;
use App\Post;
use App\Board;
use App\Http\Requests\StorePost;
use App\Http\Requests\StoreThread;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
            $this->storeFile($request, $board_name, $new_thread->num, $new_thread);            
        }

        // Archiving the last sinking thread if there are more too many active threads (default: 10)

        if($threads->count() > env('SHELTER_THREADS_ON_PAGE', 10) && $threads->last()->status == 'sinking') {
            $threads->last()->status = 'archived';
            $threads->last()->save();
        }

        return $new_thread;
    }

    public function delete($board_name, $num) 
    {
        $board = Board::where('name_short', $board_name)->firstOrFail();
        $post = $board->posts()->where('num', $num)->firstOrFail();

        $post->status = 'archived';
        $post->save();
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
            $this->storeFile($request, $board_name, $thread_num, $new_post);
        }

        // Bumping thread until it reaches post limit (default: 500)

        if ($thread->activeChildren()->get()->count() < env('SHELTER_BUMP_LIMIT', 500) && $thread->status == 'active') {
            if (!$new_post->is_sage)
                $thread->updated_at = $new_post->created_at;
        } else {
            $thread->status = 'sinking';
        }

        $thread->save();
    }

    public function storeFile($request, $board_name, $thread_num, Post $post) 
    {
        foreach ($request->file('filename') as $file) {
            $query_file = File::where('hash', sha1_file($file))->first();

            if(!$query_file) {

                $db_file_entry = $post->files()->create([
                    'hash' => sha1_file($file),
                    'name' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'type' => $file->getClientMimeType(),
                    'size' => $file->getClientSize(),
                ]);

                $thumbnail = Image::make($file)->resize(null, env('SHELTER_THUMBNAIL_SIZE_PX', 80), function ($constraint) {
                    $constraint->aspectRatio();
                });


                Storage::disk('public')->put($board_name . '/' . $thread_num .'/thumbnails/'. $file->getClientOriginalName(), 
                    (string) $thumbnail->encode());
                Storage::disk('public')->putFileAs($board_name . '/' . $thread_num . '/', $file, 
                    $file->getClientOriginalName());

            } else {
                $post->files()->attach($query_file);
            }
        }
    }
}
