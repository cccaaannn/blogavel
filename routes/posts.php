<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/posts/me', [PostsController::class, 'myPostsPage']);
    Route::get('/posts/create', [PostsController::class, 'createPostPage']);
    Route::get('/posts/{post}/edit', [PostsController::class, 'editPostPage']);
    
    Route::post('/posts', [PostsController::class, 'createPost']);
    Route::put('/posts/{post}', [PostsController::class, 'updatePost']);
    Route::delete('/posts/{post}', [PostsController::class, 'deletePost']);
});


Route::get('/posts', [PostsController::class, 'postsPage']);
Route::get('/posts/{post}', [PostsController::class, 'postPage']);

