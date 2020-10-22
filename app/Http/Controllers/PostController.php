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
            'posts' => Post::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function show(Post $post)
    {
        return Inertia::render('Post', [
            'post' => $post,
        ]);
    }

    public function store(Request $request)
    {
        $request->validateWithBag('createPost', [
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
        ]);

        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
        ]);
            
        return redirect($post->path());
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts', [], 303);
    }
}
