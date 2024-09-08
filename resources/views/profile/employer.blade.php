@extends('layouts.app')

@section('content')
    <h1>Employer Profile</h1>
    <p>Name: {{ $user->name }}</p>
    <img src="{{ asset($user->profile_pic) }}" alt="Profile Picture">

    <a href="{{ route('profile.editEmployer', auth()->user()->employer->id) }}">Edit Profile</a>

    <h2>{{ auth()->user()->employer->company_name }}</h2>
    <p>{{ auth()->user()->employer->company_website }}</p>

    <h2>Your Posts</h2>
    @foreach($posts as $post)
        <p>{{ $post->title }}</p>
        <p>Application Deadline: <span>{{ $post->application_deadline }}</span></p>
        <a class="btn btn-success" href="{{ route('posts.show', ['id' => $post->id]) }}">View Post</a>
        



    @endforeach
@endsection
