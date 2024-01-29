<?php

namespace App\Http\Controllers\Blog\Like;

use App\Http\Controllers\Controller;
use App\Models\Post;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        auth()->user()->likedPosts()->toggle($post->id);
        return redirect()->back();
    }
}
