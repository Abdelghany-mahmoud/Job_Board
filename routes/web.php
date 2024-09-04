<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Job_seekerController;
use App\Http\Controllers\PostsController;

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
