<?php

use App\Http\Controllers\Personal\IndexController;
use App\Http\Controllers\Personal\Post\PostController;
use App\Http\Controllers\Personal\TagController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'personal',  'middleware'=>'auth'], function (){
    Route::get('/', [IndexController::class, 'index'])->name('personal.main.index');


    Route::group(['prefix'=>'posts'], function (){
            Route::get('/', [PostController::class, 'index'])->name('personal.post.index');
            Route::get('/create', [PostController::class, 'create'])->name('personal.post.create');
            Route::post('/create', [PostController::class, 'store'])->name('personal.post.store');
            Route::get('/{post}', [PostController::class, 'show'])->name('personal.post.show');
            Route::get('/{post}/edit', [PostController::class, 'edit'])->name('personal.post.edit');
            Route::patch('/{post}', [PostController::class, 'update'])->name('personal.post.update');
            Route::delete('/{post}', [PostController::class, 'delete'])->name('personal.post.delete');
    });
    Route::group(['prefix' => 'tags'], function (){
        Route::get('/get/titles', [TagController::class, 'getTitles'])->name('tags.get.titles');
    });
});

Auth::routes();
