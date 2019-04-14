<?php

namespace App\Services;

use Auth;
use App\File;
use App\Post;
use App\Thread;
use App\Http\Requests\StorePublication;

class PostService
{
   
    public function store(StorePublication $request, Thread $thread)
    {
        $user = Auth::user();
        
        $newPost = $thread->posts()->create([
            'parent_link_id' => $request->has('parent_link_id') ? $request->parent_link_id : null,
            'user_id' => $user->id,
            'text' => $request->text,
        ]);
            
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $queryFile = File::where('hash', sha1_file($file))->firstOrFail();
                $newPost->files()->attach($queryFile);
            }
        }
        
        return $newPost;
    }

    public function delete(Post $post) 
    {
        $post->status = 'archived';
        $post->save();

        return $post;
    }
}
