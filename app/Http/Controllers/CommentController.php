<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
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
            
        return back();
    }

    public function update(Post $post, Comment $comment, Request $request)
    {
        $request->validateWithBag('editComment', [
            'body' => ['required', 'string'],
        ]);

        $comment->update([
            'body' => $request->body,
        ]);

        return back();
    }

    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();

        return back();
    }
}
