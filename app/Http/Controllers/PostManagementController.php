<?php

namespace App\Http\Controllers;



    use App\Models\Post;
    use Illuminate\Http\Request;
    
    class PostManagementController extends Controller
    {
        // Method to approve post request
        public function approve(Post $post)
        {
            // Ensure the post is in pending status
            if ($post->status !== 'pending') {
                return redirect()->back()->with('error', 'Invalid post status');
            }
    
            // Update post status to approved
            $post->status = 'approved';
            $post->save();
    
            return redirect()->back()->with('success', 'Post approved successfully');
        }
    
        // Method to deny post request
        public function deny(Post $post)
        {
            // Ensure the post is in pending status
            if ($post->status !== 'pending') {
                return redirect()->back()->with('error', 'Invalid post status');
            }
    
            // Update post status to denied
            $post->status = 'rejected';
            $post->save();
    
            return redirect()->back()->with('success', 'Post rejected');
        }
    }
    
