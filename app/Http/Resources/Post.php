<?php

namespace App\Http\Resources;

use App\Http\Resources\User as UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
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
            'body' => $this->body,
            'path' => $this->path,
            'creator' => (new UserResource($this->creator)),
            'comments_count' => $this->comments_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'update_post' => auth()->check() ? auth()->user()->can('update', $this->resource) : false,
            'delete_post' => auth()->check() ? auth()->user()->can('delete', $this->resource) : false,
        ];
    }
}
