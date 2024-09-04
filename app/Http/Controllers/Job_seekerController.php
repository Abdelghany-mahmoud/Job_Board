<?php

namespace App\Http\Controllers;

use App\Models\Job_seeker;
use Illuminate\Http\Request;

class Job_seekerController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $job_seeker = Job_seeker::findOrFail($id);
        return view('profile.show', compact('job_seeker'));
    }
    


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $job_seeker = Job_seeker::findOrFail($id);
        return view('profile.edit', compact('job_seeker'));
    }
    
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $job_seeker = Job_seeker::findOrFail($id);
        $user = auth()->user(); // Assuming the authenticated user is the job seeker
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'skills' => 'nullable|string',
            'phone' => 'nullable|string|max:15',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
 
        if ($request->hasFile('profile_pic')) {
            // Store the new profile picture
            $filePath = $request->file('profile_pic')->store('profile_pics', 'profile_pics');
            $job_seeker->profile_pic = $filePath;
        }
        
        // Update fields in the users table
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
    
        // Update other fields in the job_seekers table
        $job_seeker->skills = $request->input('skills');
        $job_seeker->phone = $request->input('phone');
        $job_seeker->location = $request->input('location');
        $job_seeker->bio = $request->input('bio');
    
        $job_seeker->save();
    
        return back()->with('success', 'Profile updated successfully.');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job_seeker $job_seeker)
    {
        //
    }
}
