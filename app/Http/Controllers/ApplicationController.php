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
        // public function create(Post $post)
        // {
        //     return view('applications.create', compact('post'));
        // }
        public function create(Post $post)
        {
            // Check if the authenticated user has the 'employer' role
            if (auth()->user()->role === 'employer') {
                // Redirect or abort with an error message
                return redirect()->back()->with('error', 'Employers cannot apply for jobs.');
            }
        
            // If the user is not an employer, show the application form
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
        public function showApplicationStatus()
    {
        $userId = Auth::id(); // Get the current authenticated user ID
        $applications = Application::where('user_id', $userId)->with('post')->get(); // Fetch applications for the current user with related posts

        return view('applications.status', compact('applications')); // Pass applications to the view
    }

    public function showApplications()
    {
        $userId = Auth::id(); // Get the current authenticated user ID
        $applications = Application::where('user_id', $userId)->with('post')->paginate(10); // Fetch paginated applications

        return view('applications.status', compact('applications')); // Pass paginated applications to the view
    }

    public function updateApplication(Request $request, $applicationId)
    {
        $request->validate([
            'reply' => 'nullable|string',
        ]);

        $application = Application::where('user_id', Auth::id())->findOrFail($applicationId); // Ensure user owns the application
        $application->reply = $request->input('reply');
        $application->save();

        return redirect()->route('applications.status')->with('success', 'Application updated successfully.');
    }
    }
    

