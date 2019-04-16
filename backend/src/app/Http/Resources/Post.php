<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\File as FileResource;
use App\Http\Resources\User as UserResource;

use Auth;

class Post extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'link_id' => $this->link_id,
            'parent_link_id' => $this->parent_link_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'text' => $this->text,
            'rating' => $this->rating,
            'created_at' => $this->created_at->format('Y/m/d H:i:s'),
            'files' => FileResource::collection($this->whenLoaded('files')),
            'posts' => $this->collection($this->whenLoaded('replies')),
        ];
    }
}
