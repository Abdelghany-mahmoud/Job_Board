@extends('layouts.app')

@section('content')
    <h1>Employer Profile</h1>

    <p>Name: {{ $user->name }}</p>
    <img src="{{ asset($user->profile_pic) }}" alt="Profile Picture">
    <a href="{{ route('profile.editEmployer', auth()->user()->employer->id) }}">Edit Profile</a>

    {{-- Check if the employer exists before accessing its properties --}}
    @if(auth()->user()->employer)

        {{-- Only display company details if they exist --}}
        @if(auth()->user()->employer->company_name || auth()->user()->employer->company_website)
            <h2>{{ auth()->user()->employer->company_name }}</h2>
            <p>{{ auth()->user()->employer->company_website }}</p>
        @endif
    @else
        <p>You are not associated with an employer yet.</p>
    @endif

    <h2>Your Posts</h2>
    @if($posts->isEmpty())
        <p>No posts available.</p>
    @else
        @foreach($posts as $post)
            <p>{{ $post->title }}</p>
            <p>Application Deadline: <span>{{ $post->application_deadline }}</span></p>
            <a class="btn btn-success" href="{{ route('posts.show', ['post' => $post->id]) }}">View Post</a>
            @endforeach
    @endif
@endsection
