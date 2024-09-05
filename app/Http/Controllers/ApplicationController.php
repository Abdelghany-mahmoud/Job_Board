<?php
namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
    
    class ApplicationController extends Controller
    {
        /**
         * Show the form for creating a new application.
         */
        public function create(Post $post)
        {
            return view('applications.create', compact('post'));
        }
    
        /**
         * Store a newly created application in storage.
         */
        public function store(Request $request)
        {
            $request->validate([
                'post_id' => 'required|exists:posts,id',
                'content' => 'required|string|max:1000',
                'expected_salary' => 'nullable|numeric|min:0',
            ]);
    
            Application::create([
                'post_id' => $request->input('post_id'),
                'user_id' => Auth::id(),
                'content' => $request->input('content'),
                'expected_salary' => $request->input('expected_salary'),
            ]);
    
            return redirect()->route('posts.show', $request->input('post_id'))->with('success', 'Application submitted successfully');
        }
    }
    

