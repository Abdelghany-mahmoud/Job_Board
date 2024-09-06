<?php


namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Admin;
    use App\Models\Employer;
    use App\Models\Job_seeker;
    use App\Models\Post; // Model for posts
    use App\Models\Application; // Model for applications
    
    class ProfileController extends Controller
    {
        public function showProfile()
        {
            $user = auth()->user();
    
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
    
            return redirect()->route('profile.editJobSeeker', $job_seeker->id)->with('success', 'Profile updated successfully');
        }

        // public function editEmployer(Employer $employer)
        // {
        //     return view('profile.edit-employer', compact('employer'));
        // }
        public function editEmployer($id)
        {
            $employer = Employer::findOrFail($id);
            return view('profile.editEmployer', compact('employer'));
        }
        
        // Update Employer profile
        public function updateEmployer(Request $request, Employer $employer)
        {
            $validated = $request->validate([
                'profile_pic' => 'nullable|image',
                // Add other fields specific to employer if needed
            ]);
    
            if ($request->hasFile('profile_pic')) {
                $path = $request->file('profile_pic')->store('profile_pics', 'profile_pics');
                $employer->profile_pic = $path;
            }
    
            $employer->update($validated);
    
            return redirect()->route('profile.editEmployer', $employer->id)->with('success', 'Profile updated successfully');
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


    //     // }
    //     public function show()
    // {
    //     $user = auth()->user();
    //     $posts = [];
    //     $applications = [];
    //     $postsRequests = [];
    //         $job_seeker=[];
    //     if ($user->role == 'employer') {
    //         $posts = $user->employer->posts;
    //         $applications = $user->employer->applications;
    //     } elseif ($user->role == 'admin') {
    //         // $postsRequests = PostRequest::all(); // Assuming you have a PostRequest model for post requests
    //     } elseif ($user->role == 'job_seeker') {
    //         $job_seeker = $user->jobSeeker;
    //     }

    //     return view('profile.show', compact('user', 'posts', 'applications', 'postsRequests', 'job_seeker'));
    // }

   
//         public function editProfile()
// {
//     $user = auth()->user();

//     if ($user->role == 'job_seeker') {
//         $job_seeker = $user->jobSeeker;
//         return view('profile.editProfile', compact('job_seeker'));
//     } elseif ($user->role == 'employer') {
//         $employer = $user->employer;
//         return view('profile.editProfile', compact('employer'));
//     } elseif ($user->role == 'admin') {
//         $admin = $user->admin;
//         return view('profile.editProfile', compact('admin'));
//     }
// }

// public function updateProfile(Request $request)
// {
//     $user = auth()->user();

//     if ($user->role == 'job_seeker') {
//         $job_seeker = $user->jobSeeker;
//         $job_seeker->update($request->except('profile_picture'));

//         if ($request->hasFile('profile_picture')) {
//                 $path = $request->file('profile_pic')->store('profile_pics', 'profile_pics');
//         $job_seeker->profile_picture = $path;
//             $job_seeker->save();
//         }

//         return redirect()->route('profile.show');
//     } elseif ($user->role == 'employer') {
//         $employer = $user->employer;
//         $employer->update($request->except('company_logo'));

//         if ($request->hasFile('company_logo')) {
//             $path = $request->file('company_logo')->store('company_logos', 'public');
//             $employer->company_logo = $path;
//             $employer->save();
//         }

//         return redirect()->route('profile.show');
//     } elseif ($user->role == 'admin') {
//         $admin = $user->admin;
//         $admin->update($request->except('profile_picture'));

//         if ($request->hasFile('profile_picture')) {
//             $path = $request->file('profile_picture')->store('admin_pics', 'public');
//             $admin->profile_picture = $path;
//             $admin->save();
//         }

//         return redirect()->route('profile.show');
//     }
// }

    }


    
    
