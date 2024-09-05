<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Job_seekerController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ApplicationController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/profile/{id}', [Job_seekerController::class, 'show'])->name('profile.show');
Route::post('/profile/{id}', [Job_seekerController::class, 'update'])->name('profile.update');
Route::get('/profile/edit/{id}', [Job_seekerController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{id}', [Job_seekerController::class, 'update'])->name('profile.update');

Route::resource('posts', PostsController::class);


Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');



Route::get('applications/create/{post}', [ApplicationController::class, 'create'])->name('applications.create');
Route::post('applications', [ApplicationController::class, 'store'])->name('applications.store');
