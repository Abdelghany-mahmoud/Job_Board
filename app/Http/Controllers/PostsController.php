<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Technology;
use App\Models\Technologies_post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth')->only('store', 'update');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        $Technologies_post = Technologies_post::all();
        return view('posts.index', ["posts" => $posts, 'Technologies_post' => $Technologies_post]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technologies = Technology::all();
        $categories = Category::all();
        return view('posts.create', ['technologies' => $technologies, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $technologies = $request->technologies;
        $post = Post::create($data);

        foreach ($technologies as $technology) {
            Technologies_post::insert([
                'post_id' => $post->id,
                'technology_id' => $technology,
            ]);
        }
        return redirect()->route('posts.index')->with('success', 'Post cereated successfully');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Post $post)
    // {
    //     //
    // }
    public function show(Post $post)
    {
        // Eager load comments and technologies relationships
        $post->load('comments', 'technologies');
    
        // Paginate comments if necessary
        $comments = $post->comments()->paginate(10);
    
        return view('posts.show', [
            'post' => $post,
            'comments' => $comments
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
{
    // Get all technologies and categories for the form
    $technologies = Technology::all();
    $categories = Category::all();
    
    // Get the selected technologies for this post
    $selectedTechnologies = $post->technologies->pluck('id')->toArray();
    
    return view('posts.edit', [
        'post' => $post,
        'technologies' => $technologies,
        'categories' => $categories,
        'selectedTechnologies' => $selectedTechnologies
    ]);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post)
    {
        // Validate the request
        $data = $request->validated();
        $data['user_id'] = Auth::id(); // Make sure to assign the user_id
    
        // Update the post
        $post->update($data);
    
        // Update the technologies associated with the post
        $technologies = $request->technologies;
        $post->technologies()->sync($technologies);
    
        return redirect()->route('posts.show')->with('success', 'Post updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
