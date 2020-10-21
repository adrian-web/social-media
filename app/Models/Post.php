<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $with = ['creator'];

    protected $appends = ['path'];

    public function path()
    {
        return "/posts/{$this->id}";
    }

    public function getPathAttribute()
    {
        return $this->path();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
