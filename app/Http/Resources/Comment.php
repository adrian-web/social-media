<?php

namespace App\Http\Resources;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\Post as PostResource;
use App\Models\Comment as ModelsComment;
use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
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
            'body' => $this->body,
            'owner' => (new UserResource($this->owner)),
            'post' => (new PostResource($this->post)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'update_comment' => auth()->user()->can('update', ModelsComment::find($this->id)),
            'delete_comment' => auth()->user()->can('delete', ModelsComment::find($this->id)),
        ];
    }
}
