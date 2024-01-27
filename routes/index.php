<?php


use App\Http\Controllers\Blog\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('main.index');
