<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Technology;
use App\Models\Technologies_post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class postsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

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
    public function store(Request $request)
    {
        // dd($request);
        $technologies = $request->technologies;
        $post = Post::create([
            // 'user_id' => Auth::id(),
            'user_id' => 1,
            'title'=>$request->title,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
            'requirements'=>$request->requirements,
            'responsibilities'=>$request->responsibilities,
            'benefits'=>$request->benefits,
            'location'=>$request->location,
            'work_type'=>$request->work_type,
            'min_salary'=>$request->min_salary,
            'max_salary'=>$request->max_salary,
            'application_deadline'=>$request->application_deadline,
        ]);
        foreach ($technologies as $technology) {
            Technologies_post::insert([
                'post_id' => $post->id,
                'technology_id' => $technology,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
