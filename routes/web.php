<?php

use App\Http\Controllers\PostController;
use App\Http\Middleware\BlogMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::middleware(BlogMiddleware::class)
    ->prefix('blog')
    ->group(function () {
        Route::get('post', [PostController::class, 'index'])->name('post.index');
        Route::get('post/{post:slug}', [PostController::class, 'show'])->name('post.show');
    });
