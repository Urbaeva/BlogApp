<?php


use App\Http\Controllers\Blog\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('blog.index');
Route::get('/{post}', [IndexController::class, 'show'])->name('blog.show');

