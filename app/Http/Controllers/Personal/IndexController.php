<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $data = [];
        $data['postsCount'] = Post::all()->count();
        return view('personal.main.index', compact('data'));
    }
}
