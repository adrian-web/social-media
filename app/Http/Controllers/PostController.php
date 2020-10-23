<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\Comment as CommentResource;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        return Inertia::render('Posts', [
            'posts' => PostResource::collection(Post::orderBy('created_at', 'desc')->simplePaginate(10)),
        ]);
    }

    public function show(Post $post)
    {
        return Inertia::render('Post', [
            'post' => (new PostResource($post)),
            'comments' => CommentResource::collection($post->comments()->simplePaginate(5)),
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

    public function update(Post $post, Request $request)
    {
        $request->validateWithBag('editPost', [
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
        ]);

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return back();
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts');
    }
}
