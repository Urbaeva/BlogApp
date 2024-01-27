<?php

use App\Http\Controllers\Personal\Category\CategoryController;
use App\Http\Controllers\Personal\IndexController;
use App\Http\Controllers\Personal\Post\PostController;
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

Route::group(['prefix' => 'personal'], function (){
    Route::get('/', [IndexController::class, 'index'])->name('personal.main.index');

    Route::group(['prefix'=>'categories'], function (){
        Route::get('/', [CategoryController::class, 'index'])->name('personal.category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('personal.category.create');
        Route::post('/create', [CategoryController::class, 'store'])->name('personal.category.store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('personal.category.show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('personal.category.edit');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('personal.category.update');
        Route::delete('/{category}', [CategoryController::class, 'delete'])->name('personal.category.delete');
    });

    Route::group(['prefix'=>'posts'], function (){
            Route::get('/', [PostController::class, 'index'])->name('personal.post.index');
            Route::get('/create', [PostController::class, 'create'])->name('personal.post.create');
            Route::post('/create', [PostController::class, 'store'])->name('personal.post.store');
            Route::get('/{post}', [PostController::class, 'show'])->name('personal.post.show');
            Route::get('/{post}/edit', [PostController::class, 'edit'])->name('personal.post.edit');
            Route::patch('/{post}', [PostController::class, 'update'])->name('personal.post.update');
            Route::delete('/{post}', [PostController::class, 'delete'])->name('personal.post.delete');
    });

});

Auth::routes();
