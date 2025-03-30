<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\BlogMiddleware;
use App\Http\Middleware\PortfolioMiddleware;
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

Route::middleware(PortfolioMiddleware::class)
    ->prefix('portfolio')
    ->group(function () {
        Route::get('album', [AlbumController::class, 'index'])->name('album.index');
        Route::get('album/{album:slug}', [AlbumController::class, 'show'])->name('album.show');
    });
