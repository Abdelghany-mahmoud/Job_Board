<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class ApplicationController extends Controller
{

  public function create(Post $post)
  {
    if (Auth::user()->application->count() >= 1) {
      return redirect()->route('posts.show',$post)->with('error', 'You can\'t already apllied for this job');
      };
    // Check if the authenticated user has the 'employer' role
    if (Auth::user()->role === 'employer') {
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
  //     public function showApplicationStatus()
  // {
  //     $userId = Auth::id(); // Get the current authenticated user ID
  //     $applications = Application::where('user_id', $userId)->with('post')->get(); // Fetch applications for the current user with related posts

  //     return view('applications.status', compact('applications')); // Pass applications to the view
  // }

  public function showApplications()
  {
    $userId = Auth::id(); // Get the current authenticated user ID
    $applications = Application::where('user_id', $userId)->with('post')->paginate(10); // Fetch paginated applications

    return view('applications.status', compact('applications')); // Pass paginated applications to the view
  }

  // public function updateApplication(Request $request, $applicationId)
  // {
  //     $request->validate([
  //         'reply' => 'nullable|string',
  //     ]);

  //     $application = Application::where('user_id', Auth::id())->findOrFail($applicationId); // Ensure user owns the application
  //     $application->reply = $request->input('reply');
  //     $application->save();

  //     return redirect()->route('applications.status')->with('success', 'Application updated successfully.');
  // }

  public function edit($id)
  {
    $application = Application::where('user_id', Auth::id())->findOrFail($id); // Ensure user owns the application
    return view('applications.edit', compact('application'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'content' => 'required|string|max:1000',
      'expected_salary' => 'nullable|numeric|min:0',
    ]);

    $application = Application::where('user_id', Auth::id())->findOrFail($id); // Ensure user owns the application
    $application->update([
      'content' => $request->input('content'),
      'expected_salary' => $request->input('expected_salary'),
    ]);

    return redirect()->route('applications.status')->with('success', 'Application updated successfully.');
  }

  public function destroy($id)
  {
    $application = Application::where('user_id', Auth::id())->findOrFail($id); // Ensure user owns the application
    $application->delete();

    return redirect()->route('applications.status')->with('success', 'Application deleted successfully.');
  }

  // Admin delete function
  public function destroyAsAdmin($id)
  {
    Application::findOrFail($id)->delete(); // Admin can delete any application
    return redirect()->route('admin.applications.index')->with('success', 'Application deleted successfully.');
  }


  // public function showUserApplicationsOnPost($postId)
  // {
  //     $userId = Auth::id();
  //     $applications = Application::where('user_id', $userId)
  //         ->where('post_id', $postId)
  //         ->with('post')
  //         ->get();

  //     return view('applications.user_post_applications', compact('applications'));
  // }
  // public function showAllApplicationsOnPost($postId)
  // {
  //     $applications = Application::where('post_id', $postId)
  //         ->with('user', 'post')
  //         ->get();

  //     return view('admin.applications.post_applications', compact('applications'));
  // }

  public function showUserApplications($postId)
  {
    if (Auth::user()->role !== 'job_seeker') {
      return redirect()->back()->with('error', 'Unauthorized access.');
    }

    $applications = Application::where('user_id', Auth::id())->where('post_id', $postId)->get();
    return view('applications.user_post', compact('applications'));
  }

  public function showPostApplications($postId)
  {
    if (Auth::user()->role !== 'admin') {
      return redirect()->back()->with('error', 'Unauthorized access.');
    }

    $applications = Application::where('post_id', $postId)->get();
    return view('admin.post_applications', compact('applications'));
  }
}
