<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getTitles()
    {
        return response(['data' => Tag::all()->pluck('title')]);
    }
}
