<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(6);
        $randomPosts = [];
        $popularPosts = [];
        if(count($posts)) {
            $randomPosts = Post::inRandomOrder()->limit(4)->get();
            $popularPosts = Post::inRandomOrder()->limit(4)->get(); // it should be changed, when i add likes and comments
        }
        return view('blog.index', compact('posts', 'randomPosts', 'popularPosts'));
    }

    public function show(Post $post)
    {
        $relatedPosts = Post::whereHas('tags', function ($query) use ($post){
            $tagIds = $post->tags->pluck('id');
            $query->whereIn('tags.id', $tagIds);
        })
            ->where('id', '<>', $post->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        $date = Carbon::parse($post->created_at);
        return view('blog.show', compact('post', 'date', 'relatedPosts'));
    }
}
