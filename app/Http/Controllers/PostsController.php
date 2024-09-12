<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Technology;
use App\Models\Technologies_post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Models\Application;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store', 'update');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Retrieve the search query from the request
        $search = $request->input('search');

        // If there's a search query, filter posts by the search criteria
        if ($search) {
            $posts = Post::where('title', 'like', '%' . $search . '%')
                ->orWhere('location', 'like', '%' . $search . '%')
                ->orWhere('work_type', 'like', '%' . $search . '%')
                ->orderBy('created_at', 'desc') // Sort by latest created post
                ->get();
        } else {
            // If no search query, return all posts ordered by latest created
            $posts = Post::orderBy('created_at', 'desc')->get();
        }

        // Include the Technologies relation to avoid N+1 problem
        $Technologies_post = Technologies_post::with('technology')->get();

        // Pass the posts and the search query to the view
        return view('posts.index', compact('posts', 'Technologies_post', 'search'));
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
        return redirect()->route('posts.index')->with('success', 'Waiting for admin approval');
    }

    /**
     * Display the specified resource.
     */
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


    public function update(StorePostRequest $request, Post $post,)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id(); // Make sure to assign the user_id

        // Update the post

        $post->update($data);

        // Update the technologies associated with the post
        $technologies = $request->technologies;
        $post->technologies()->sync($technologies);
        $post->status = 'pending';
        $post->save();
        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully');
    }
    public function showPostApplications($postId)
    {
        if (Auth::user()->role === "admin") {
            $post = Post::with('applications.user')->findOrFail($postId);
        } else {

            $post = Post::where('user_id', Auth::id())->with('applications.user')->findOrFail($postId);
        }
        $applications = $post->applications()->paginate(10); // Paginate applications

        return view('posts.applications', compact('post', 'applications'));
    }

    public function replyToApplication(Request $request, $applicationId)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $application = Application::findOrFail($applicationId);
        $application->reply = $request->input('reply');
        $application->status = 'replied';
        $application->save();

        return redirect()->route('posts.applications', $application->post_id)->with('success', 'Application replied successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return  redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

    public function approveApplication($applicationId)
    {
        $application = Application::findOrFail($applicationId);
        $application->status = 'accepted';
        $application->save();

        return redirect()->route('posts.applications', $application->post_id)->with('success', 'Application approved successfully.');
    }

    public function denyApplication($applicationId)
    {
        $application = Application::findOrFail($applicationId);
        $application->status = 'denied';
        $application->save();

        return redirect()->route('posts.applications', $application->post_id)->with('success', 'Application denied successfully.');
    }

    public function deletedPosts()
    {
        // Retrieve all soft-deleted posts
        $posts = Post::onlyTrashed()->get();
        $Technologies_post = Technologies_post::with('technology')->get();
        // Redirect back with a success message
        return view('posts.deleted', ["posts" => $posts,'Technologies_post'=>$Technologies_post]);
    }
}
