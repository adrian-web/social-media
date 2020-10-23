<?php

namespace App\Http\Resources;

use App\Http\Resources\User as UserResource;
use App\Models\Post as ModelsPost;
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
            'update_post' => auth()->user()->can('update', ModelsPost::find($this->id)),
            'delete_post' => auth()->user()->can('delete', ModelsPost::find($this->id)),
        ];
    }
}
