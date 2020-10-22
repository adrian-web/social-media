<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        return $post->comments()->get();
    }

    public function store(Post $post, Request $request)
    {
        $request->validateWithBag('createComment', [
            'body' => ['required', 'string'],
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'body' => $request->body,
        ]);
            
        return redirect($post->path());
    }

    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();

        return redirect($post->path(), 303);
    }
}
