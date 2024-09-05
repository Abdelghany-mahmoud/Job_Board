<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = Auth::id();
        $comment->commentable_type = 'App\Models\Post';
        $comment->commentable_id = $postId;
        $comment->save();

        return redirect()->route('posts.show', $postId)->with('success', 'Comment added successfully');
    }
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
    
        return view('comments.edit', compact('comment'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);
    
        $comment = Comment::findOrFail($id);
        $comment->content = $request->input('content');
        $comment->save();
    
        return redirect()->route('posts.show', $comment->commentable_id)->with('success', 'Comment updated successfully');
    }
    

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('posts.show', $comment->commentable_id)->with('success', 'Comment deleted successfully');
    }
}
