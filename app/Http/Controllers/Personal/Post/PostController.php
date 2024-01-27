<?php

namespace App\Http\Controllers\Personal\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;

class PostController extends Controller
{
    private $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $posts = Post::all();
        return view('personal.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('personal.post.create', compact('categories'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);
        return redirect()->route('personal.post.index');
    }

    public function show(Post $post)
    {
        return view('personal.post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('personal.post.edit', compact('post','categories'));
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();
        $this->service->update($data, $post);
        return redirect()->route('personal.post.index');
    }

    public function delete(Post $post)
    {
        $post->delete();
        return redirect()->route('personal.post.index');
    }
}
