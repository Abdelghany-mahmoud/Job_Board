<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Employer;
use App\Models\User;
use App\Models\Job_seeker;
use App\Models\Post; // Model for posts
use App\Models\Application; // Model for applications
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{



    public function editJobSeeker(Job_seeker $job_seeker)
    {
        return view('profile.edit-job-seeker', compact('job_seeker'));
    }

    // Update Job Seeker profile
    public function updateJobSeeker(Request $request, Job_seeker $job_seeker)
    {
        $validated = $request->validate([
            'profile_pic' => 'nullable|image',
            'linkedin_profile' => 'nullable|url',
            'skills' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);

        // Handle profile picture upload if present
        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('profile_pics', 'profile_pics');
            $job_seeker->profile_pic = $path;
        }

        // Update other fields
        $job_seeker->update($validated);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully');
    }


    public function editEmployer($id)
    {
        $employer = Employer::findOrFail($id);
        return view('profile.edit-employer', compact('employer'));
    }

    public function updateEmployer(Request $request, Employer $employer)
    {
        // Validate the request
        $validated = $request->validate([
            'profile_pic' => 'nullable|image',
            'name' => 'required|string|max:255', // Add validation for the name field
        ]);

        // Check if the employer has an associated user
        if ($employer->user) {
            // Update the user's name
            $user = $employer->user;
            $user->name = $validated['name'];
            $user->save(); // Save the updated user data
        } else {
            // If there is no associated user, redirect back with an error message
            return redirect()->back()->withErrors('Employer does not have an associated user.');
        }

        // Handle profile picture update for the employer
        if ($request->hasFile('profile_pic')) {
            // Store the profile picture and assign the path to the employer's profile_pic field
            $path = $request->file('profile_pic')->store('profile_pics', 'public');
            $employer->profile_pic = $path;
        }

        // Update other employer-specific fields (if any)
        $employer->update($validated);

        // Redirect to the profile page with a success message
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully');
    }


    public function editAdmin(Admin $admin)
    {
        return view('profile.edit-admin', compact('admin'));
    }

    // Update Admin profile
    public function updateAdmin(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'profile_pic' => 'nullable|image',
            // Add other fields specific to admin if needed
        ]);

        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('profile_pics', 'profile_pics');
            $admin->profile_pic = $path;
        }

        $admin->update($validated);

        return redirect()->route('profile.editAdmin', $admin->id)->with('success', 'Profile updated successfully');
    }


    public function show()
    {
        $user = Auth::user();
        switch ($user->role) {
            case 'admin':
                // Fetch admin-specific data
                $postsRequests = Post::where('status', 'pending')->get(); // Example post request logic
                return view('profile.admin', ['user' => $user, 'postsRequests' => $postsRequests]);

            case 'employer':
                // Fetch employer-specific data
                $posts = Post::where('user_id', $user->id)->get();
                $applications = Application::whereIn('post_id', $posts->pluck('id'))->get();
                return view('profile.employer', ['user' => $user, 'posts' => $posts, 'applications' => $applications]);

            case 'job_seeker':
                // Fetch job_seeker-specific data
                $jobSeeker = Job_seeker::where('user_id', $user->id)->first();
                return view('profile.job_seeker', ['user' => $user, 'job_seeker' => $jobSeeker]);

            default:
                return redirect('/'); // Redirect to a default page if role is not recognized
        }
    }
    public function PostCreatorProfile($user_id)
    {
        $user = User::findOrFail($user_id);
        $posts = Post::where('user_id', $user->id)->get();
        $applications = Application::whereIn('post_id', $posts->pluck('id'))->get();
        return view('profile.employer', ['user' => $user, 'posts' => $posts, 'applications' => $applications]);
    }
}
