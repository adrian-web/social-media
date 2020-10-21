<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        return Inertia::render('Posts', [
            'posts' => Post::all(),
        ]);
    }

    public function show(Post $post)
    {
        return Inertia::render('Post', [
            'post' => $post,
            'comments' => $post->comments()->get(),
        ]);
    }
}
