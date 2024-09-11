<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Job_seekerController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostManagementController;
use App\Http\Controllers\ApplicationManagementController;



Auth::routes();

Route::get('/', function () {
    return redirect()->route('posts.index');
});
Route::resource('posts', PostsController::class);

Route::put('/posts/{post}', [PostsController::class, 'update'])->name('posts.update');

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('newComment.store');

Route::resource('comments', CommentController::class);


Route::get('applications/create/{post}', [ApplicationController::class, 'create'])->name('applications.create');
Route::post('applications', [ApplicationController::class, 'store'])->name('applications.store');

Route::get('/posts/{post}', [PostsController::class, 'show'])->name('posts.show');


Route::middleware(['auth'])->group(function () {
    // Edit profile for job_seeker
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile.show');
        Route::get('/pending', [ProfileController::class, 'pendingPosts'])->middleware('auth')->name('pending.show');

    });
    

    Route::get('/profile/{job_seeker}/edit', [ProfileController::class, 'editJobSeeker'])->name('profile.editJobSeeker');
    Route::post('/profile/{job_seeker}/update', [ProfileController::class, 'updateJobSeeker'])->name('profile.updateJobSeeker');

Route::get('/profile/employer/{id}/edit', [ProfileController::class, 'editEmployer'])->name('profile.editEmployer');
Route::put('/profile/employer/{id}', [ProfileController::class, 'updateEmployer'])->name('profile.updateEmployer');


    // Edit profile for admin
    Route::get('/profile/{admin}/edit', [ProfileController::class, 'editAdmin'])->name('profile.editAdmin');
    Route::post('/profile/{admin}/update', [ProfileController::class, 'updateAdmin'])->name('profile.updateAdmin');
});

Route::middleware('auth')->group(function () {

    Route::get('/profile/{post}', [ProfileController::class, 'PostCreatorProfile'])->name('PostCreatorProfile.show');


});


Route::middleware(['auth'])->group(function () {
    // Admin routes for managing post requests
    Route::get('/posts/{post}/approve', [PostManagementController::class, 'approve'])->name('approvePost');
    Route::get('/posts/{post}/deny', [PostManagementController::class, 'deny'])->name('denyPost');

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

// Applicant routes
Route::middleware(['auth', 'role:job_seeker'])->group(function () {
    Route::get('applications/status', [ApplicationController::class, 'showApplicationStatus'])->name('applications.status');
    Route::get('applications/{id}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
    Route::put('applications/{id}', [ApplicationController::class, 'update'])->name('applications.update');
    Route::delete('applications/{id}', [ApplicationController::class, 'destroy'])->name('applications.destroy');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/applications', [ApplicationController::class, 'showAllApplications'])->name('admin.applications.show');
    Route::delete('admin/applications/{id}', [ApplicationController::class, 'destroyAsAdmin'])->name('admin.applications.destroy');
});



Route::get('applications/user/post/{postId}', [ApplicationController::class, 'showUserApplications'])->name('applications.user.post');
Route::get('applications/status', [ApplicationController::class, 'showApplications'])->name('applications.status');
// Route::get('admin/applications/post/{postId}', [AdminController::class, 'showPostApplications'])->name('admin.applications.post');
