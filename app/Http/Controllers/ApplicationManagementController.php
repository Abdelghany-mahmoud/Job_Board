<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationManagementController extends Controller
{
    // Method to accept a job application
    public function accept(Application $application)
    {
        // Check if the employer owns the post
        $this->authorize('update', $application->post); // Ensure the employer is authorized

        // Update application status to accepted
        $application->status = 'accepted';
        $application->save();

        return redirect()->back()->with('success', 'Application accepted successfully');
    }

    // Method to reply to a job application (e.g., send a message)
    public function reply(Request $request, Application $application)
    {
        $this->authorize('update', $application->post); // Ensure the employer is authorized

        // Validate the reply content
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // Add reply to the application (this assumes you have a `reply` field in your applications table)
        $application->reply = $request->message;
        $application->status = 'replied';
        $application->save();

        return redirect()->back()->with('success', 'Reply sent successfully');
    }

    // Method to deny a job application
    public function deny(Application $application)
    {
        $this->authorize('update', $application->post); // Ensure the employer is authorized

        // Update application status to denied
        $application->status = 'denied';
        $application->save();

        return redirect()->back()->with('success', 'Application denied successfully');
    }
}

