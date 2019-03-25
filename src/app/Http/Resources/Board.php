<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Board extends Resource
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
            'id' => $this->id,
            'name' => $this->name,
            'name_short' => $this->name_short,
            'last_post_num' => $this->last_post_num,
        ];
    }
}
