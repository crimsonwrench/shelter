<?php

namespace App\Services;

use Auth;
use App\File;
use App\Board;
use App\Thread;
use App\Http\Resources\Thread as ThreadResource;
use App\Http\Requests\StorePublication;
use Illuminate\Support\Str;

class ThreadService 
{
    public function show(Board $board, $threadLink)
    {
        $thread = $board->threads()
            ->with(
                'user', 
                'files', 
                'rootPosts.files', 
                'rootPosts.user', 
                'rootPosts.replies.files', 
                'rootPosts.replies.user'
            )
            ->withCount('allPosts as posts_count')
            ->where('link_id', $threadLink)
            ->where('status', '!=', 'archived')
            ->firstOrFail();
        
        return new ThreadResource($thread);
    }
    
    public function store(StorePublication $request, Board $board)
    {
        $user = Auth::user();

        $newThread = $board->threads()->create([
            'link_id' => Str::random(10),
            'user_id' => $user->id,
            'title' => $request->title,
            'text' => $request->text,
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $queryFile = File::where('hash', sha1_file($file))->firstOrFail();
                $newThread->files()->attach($queryFile);
            }
        }

        return $newThread;
    }

    public function delete(Thread $thread)
    {
        $thread->status = 'archived';
        $thread->save();

        return $thread;
    }

}