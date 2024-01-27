<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(6);
        $randomPosts = Post::get()->random(4);
        return view('blog.index', compact('posts', 'randomPosts'));
    }
}
