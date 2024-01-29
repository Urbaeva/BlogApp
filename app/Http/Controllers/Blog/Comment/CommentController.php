<?php

namespace App\Http\Controllers\Blog\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'message' => 'required|string|max:255',
        ]);
        $data['post_id'] = $post->id;
        $data['user_id'] = auth()->user()->id;
        Comment::create($data);
        return redirect()->route('blog.show', $post->id);
    }
}
