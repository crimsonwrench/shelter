<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\File as FileResource;
use App\Http\Resources\Post as PostResource;


class Thread extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'link_id' => $this->link_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'title' => $this->title,
            'text' => $this->text,
            'rating' => $this->rating,
            'is_sticky' => $this->is_sticky,
            'status' => $this->status,
            'created_at' => $this->updated_at->format('Y/m/d H:i:s'),
            'files' => FileResource::collection($this->whenLoaded('files')),
            'posts' => PostResource::collection($this->whenLoaded('rootPosts')),
            'replies_count' => $this->posts_count ?: 0,
        ];
    }
}
