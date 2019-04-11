<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\File as FileResource;
use Illuminate\Support\Facades\DB;
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
            'board_id' => $this->board_id,
            'num' => $this->num,
            'belongs_to' => $this->belongs_to,
            'title' => $this->title,
            'text' => $this->text,
            'posted_on' => $this->updated_at->format('Y/m/d H:i:s'),
            'is_op' => $this->is_op,
            'is_sage' => $this->is_sage,
            'is_sticky' => $this->is_sticky,
            'files' => FileResource::collection($this->whenLoaded('files')),
            'posts' => $this->collection($this->whenLoaded('activeChildren')),
        ];
    }
}
