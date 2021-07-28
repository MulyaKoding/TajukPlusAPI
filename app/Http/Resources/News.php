<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class News extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'writer' => $this->writer,
            'category' => $this->category,
            'tag' => $this->tag,
            'viewed' => $this->viewed,
            'shared' => $this->shared,
            'liked' => $this->liked,
            'content' => $this->content,
            'cover' => $this->cover,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y')
        ];
    }
}