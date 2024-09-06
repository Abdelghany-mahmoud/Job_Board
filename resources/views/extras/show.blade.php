@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ ucfirst(auth()->user()->role) }} Profile</h1>
    <p>Name: {{ $user->name }}</p>
    <img src="{{ asset(auth()->user()->profile_pic) }}" alt="Profile Picture">

    <!-- Edit Profile Link -->
    @if(auth()->user()->role == 'job_seeker')
        <a href="{{ route('profile.editJobSeeker', auth()->user()->job_seeker->id) }}">Edit Profile</a>
    @elseif(auth()->user()->role == 'employer')
        <a href="{{ route('profile.editEmployer', auth()->user()->employer->id) }}">Edit Profile</a>
    @elseif(auth()->user()->role == 'admin')
        <a href="{{ route('profile.editAdmin', auth()->user()->admin->id) }}">Edit Profile</a>
    @endif

    <!-- Display Additional Content Based on Role -->
    @if(auth()->user()->role == 'employer')
        <h2>{{ auth()->user()->employer->company_name }}</h2>
        <p>{{ auth()->user()->employer->company_website }}</p>

        <h2>Your Posts</h2>
        @foreach($posts as $post)
            <p>{{ $post->title }}</p>
            <p>Application Deadline: <span>{{ $post->application_deadline }}</span></p>
            <a class="btn btn-success" href="{{ route('posts.show', ['id' => $post->id]) }}">View Post</a>

            <h3>Applications</h3>
            @foreach($applications->where('post_id', $post->id) as $application)
                <p>{{ $application->user->name }} applied</p>
                <form action="{{ route('acceptApplication', $application->id) }}" method="POST">
                    @csrf
                    <button type="submit">Accept</button>
                </form>
                <form action="{{ route('replyApplication', $application->id) }}" method="POST">
                    @csrf
                    <textarea name="message" placeholder="Reply to applicant"></textarea>
                    <button type="submit">Reply</button>
                </form>
                <form action="{{ route('denyApplication', $application->id) }}" method="POST">
                    @csrf
                    <button type="submit">Deny</button>
                </form>
            @endforeach
        @endforeach
    @elseif(auth()->user()->role == 'admin')
        <h2>Manage Post Requests</h2>
        @foreach($postsRequests as $postRequest)
            <p>{{ $postRequest->title }}</p>
            <a href="{{ route('approvePost', $postRequest->id) }}">Approve</a>
            <a href="{{ route('denyPost', $postRequest->id) }}">Deny</a>
        @endforeach
    @elseif(auth()->user()->role == 'job_seeker')
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img src="{{ asset('uploads/profile_pics/' . $job_seeker->profile_picture) }}" class="card-img-top img-fluid rounded-circle" alt="Profile Picture">
                    <div class="card-body text-center">
                        <h4 class="card-title">{{ auth()->user()->name }}</h4>
                        <p class="card-text">{{ $job_seeker->bio }}</p>
                        <a href="{{ route('profile.editJobSeeker', auth()->user()->job_seeker->id) }}">Edit Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h5>Profile Details</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Skills:</strong> {{ $job_seeker->skills }}</p>
                        <p><strong>Phone:</strong> {{ $job_seeker->phone }}</p>
                        <p><strong>Location:</strong> {{ $job_seeker->location }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
