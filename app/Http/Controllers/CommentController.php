<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class CommentController extends Controller
{
    // public function store(Request $request, $post)
    // {
    //     $request->validate([
    //         'content' => 'required|string|max:255',
    //     ]);

    //     $comment = new Comment();
    //     $comment->content = $request->input('content');
    //     $comment->user_id = Auth::id();
    //     $comment->commentable_type = 'App\Models\Post';
    //     $comment->commentable_id = $post;
    //     $comment->save();

    //     return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully');
    // }

    public function store(Request $request, $post)
{
    // Validate the comment input
    $request->validate([
        'content' => 'required|string|max:255',
    ]);

    // Retrieve the post
    $post = Post::findOrFail($post);

    // Get the authenticated user
    $user = Auth::user();

    // Check if the user is an employer and owns the post
    if ($user->role === 'employer' && $user->id === $post->user_id) {
        // Employers can only comment on their own posts, and their comments are hidden for others
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = $user->id;
        $comment->commentable_type = 'App\Models\Post';
        $comment->commentable_id = $post->id;
        $comment->visible_to_others = false; // Mark the comment as hidden from other users
        $comment->save();

        return redirect()->route('posts.show', $post)->with('success', 'Your comment has been added and is only visible to you.');
    } elseif ($user->role !== 'employer') {
        // Non-employers can comment freely and their comments are visible to all
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = $user->id;
        $comment->commentable_type = 'App\Models\Post';
        $comment->commentable_id = $post->id;
        $comment->visible_to_others = true; // Visible to all users
        $comment->save();

        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully.');
    } else {
        // If the user is an employer but doesn't own the post, deny the comment action
        return redirect()->route('posts.show', $post)->with('error', 'You can only comment on posts you own.');
    }
}
    public function edit($post)
    {
        $comment = Comment::findOrFail($post);
    
        return view('comments.edit', compact('comment'));
    }
    
    public function update(Request $request, $post)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);
    
        $comment = Comment::findOrFail($post);
        $comment->content = $request->input('content');
        $comment->save();
    
        return redirect()->route('posts.show', $comment->commentable_id)->with('success', 'Comment updated successfully');
    }
    

    public function destroy($post)
    {
        $comment = Comment::findOrFail($post);
        $comment->delete();

        return redirect()->route('posts.show', $comment->commentable_id)->with('success', 'Comment deleted successfully');
    }
}
