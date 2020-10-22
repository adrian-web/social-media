<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['creator'];

    protected $appends = ['path'];

    protected static function booted()
    {
        static::deleting(function ($post) {
            $post->comments->each->delete();
        });
    }

    public function path()
    {
        return "/{$this->id}";
    }

    public function getPathAttribute()
    {
        return $this->path();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
