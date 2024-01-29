<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostUserLike;

class IndexController extends Controller
{
    public function index()
    {
        $data = [];
        $user = auth()->user();
        $data['postsCount'] = Post::where('user_id', $user->id)->count();
        $data['likesCount'] = PostUserLike::where('user_id', $user->id)->count();
        $data['commentsCount'] = Comment::where('user_id', $user->id)->count();

        return view('personal.main.index', compact('data', 'user'));
    }
}
