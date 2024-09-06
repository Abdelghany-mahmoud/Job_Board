<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Job_seekerController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ApplicationController;

// use App\Http\Controllers\UserController;



Auth::routes();
Route::get('/', function (){return redirect()->route('posts.index');});
Route::resource('posts', PostsController::class);
Route::get('/posts/{id}', [PostsController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostsController::class, 'update'])->name('posts.update');

// Route::get('/user/{id}', [UserController::class, 'show'])->name('users.show');

// Route::get('/profile/{id}', [Job_seekerController::class, 'show'])->name('profile.show');
// Route::post('/profile/{id}', [Job_seekerController::class, 'update'])->name('profile.update');
// Route::get('/profile/edit/{id}', [Job_seekerController::class, 'edit'])->name('profile.edit');
// Route::put('/profile/{id}', [Job_seekerController::class, 'update'])->name('profile.update');



Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');



Route::get('applications/create/{post}', [ApplicationController::class, 'create'])->name('applications.create');
Route::post('applications', [ApplicationController::class, 'store'])->name('applications.store');


use App\Http\Controllers\ProfileController;

Route::middleware(['auth'])->group(function () {
    // Edit profile for job_seeker

Route::get('/profile', [ProfileController::class, 'showProfile'])->middleware('auth')->name('profile.show');

    Route::get('/profile/{job_seeker}/edit', [ProfileController::class, 'editJobSeeker'])->name('profile.editJobSeeker');
    Route::post('/profile/{job_seeker}/update', [ProfileController::class, 'updateJobSeeker'])->name('profile.updateJobSeeker');

    // Edit profile for employer
    Route::get('/profile/{employer}/edit', [ProfileController::class, 'editEmployer'])->name('profile.editEmployer');
    Route::post('/profile/{employer}/update', [ProfileController::class, 'updateEmployer'])->name('profile.updateEmployer');

    // Edit profile for admin
    Route::get('/profile/{admin}/edit', [ProfileController::class, 'editAdmin'])->name('profile.editAdmin');
    Route::post('/profile/{admin}/update', [ProfileController::class, 'updateAdmin'])->name('profile.updateAdmin');
});

// Route::middleware('auth')->group(function () {

//     Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

//     // Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');

//     // Route to handle profile updates
//     // Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
// });

use App\Http\Controllers\PostManagementController;
use App\Http\Controllers\ApplicationManagementController;

Route::middleware(['auth'])->group(function () {
    // Admin routes for managing post requests
    Route::post('/posts/{post}/approve', [PostManagementController::class, 'approve'])->name('approvePost');
    Route::post('/posts/{post}/deny', [PostManagementController::class, 'deny'])->name('denyPost');

    // // Employer routes for managing applications
    // Route::post('/applications/{application}/accept', [ApplicationManagementController::class, 'accept'])->name('acceptApplication');
    // Route::post('/applications/{application}/reply', [ApplicationManagementController::class, 'reply'])->name('replyApplication');
    // Route::post('/applications/{application}/deny', [ApplicationManagementController::class, 'deny'])->name('denyApplication');
});

Route::middleware('auth')->group(function () {
    // Route for applicants to view their application status
    Route::get('/applications/status', [ApplicationController::class, 'showApplicationStatus'])->name('applications.status');

    // Route for post owners to view applications for a specific post
    Route::get('/posts/{post}/applications', [PostsController::class, 'showPostApplications'])->name('posts.applications');
});

Route::middleware('auth')->group(function () {
    // Route to handle replying to an application
    Route::post('/applications/{application}/reply', [PostsController::class, 'replyToApplication'])->name('applications.reply');

    // Route to handle approving an application
    Route::post('/applications/{application}/approve', [PostsController::class, 'approveApplication'])->name('applications.approve');

    // Route to handle denying an application
    Route::post('/applications/{application}/deny', [PostsController::class, 'denyApplication'])->name('applications.deny');
});