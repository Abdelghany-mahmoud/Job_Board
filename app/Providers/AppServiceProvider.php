<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Policies\PostPolicy;
use App\Policies\CommentPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Gate::define('update_post', function (User $user, Post $post) {
            return Auth::user()->id === $post->user_id;
        });

        Gate::policy(Post::class, PostPolicy::class);
    }

    protected $policies = [
        Comment::class => CommentPolicy::class,
            Post::class => PostPolicy::class,
        
    ];
    
}
