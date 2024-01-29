<?php

use App\Http\Controllers\Blog\Comment\CommentController;
use App\Http\Controllers\Blog\IndexController;
use App\Http\Controllers\Blog\Like\LikeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('blog.index');
Route::get('/{post}', [IndexController::class, 'show'])->name('blog.show');

Route::group(['namespace' => 'Comment', 'prefix' => '{post}/comments'], function (){
    Route::post('/', [CommentController::class, 'store'])->name('post.comment.store');
});

Route::group(['namespace' => 'Like', 'prefix' => '{post}/likes'], function (){
    Route::post('/', [LikeController::class, 'store'])->name('post.like.store');
});

