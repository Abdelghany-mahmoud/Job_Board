@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Employer Profile</h1>

    <p>Name: {{ $user->name }}</p>


    {{-- Check if the employer exists before accessing its properties --}}
    @if(auth()->user()->employer)

    @if(auth()->user()->employer->company_name && auth()->user()->employer->company_website)
    <h2>{{ auth()->user()->employer->company_name }}</h2>
    <p>{{ auth()->user()->employer->company_website }}</p>
    @endif
    @endif

    @if(Auth::user() == $user)
    <h2>Your Posts</h2>
    @else
    <h2>Posts by this user</h2>
    @endif
    @if($posts->isEmpty())
    <p>No posts available.</p>
    @else
    @foreach($posts as $post)
    <p>{{ $post->title }}</p>
    <p>Application Deadline: <span>{{ $post->application_deadline }}</span></p>
    <p>Post status: <span>{{ $post->status }}</span></p>
    <a class="btn btn-success" href="{{ route('posts.show', ['post' => $post->id]) }}">View Post</a>
    @if(Auth::user() == $user)
    <a class="btn btn-secondary" href="{{ route('posts.edit', $post->id) }}">Edit Post</a>
    @if($post->applications->count() > 0)
    <a class="btn btn-success" href="{{ route('posts.applications', $post->id) }}">View Applications</a>
    @endif
    @endif
    <hr>
    @endforeach
    @endif
</div>

@endsection