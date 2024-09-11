@extends('layouts.app')
<style>


    .employer-profile {
        border: 1px solid #DFDEDA;
        border-radius: 5px;
        width: 70%;
        margin: auto;

    }

    .info {
        padding: 20px;
    }

    .name {
        margin-top: -20px;
        text-align: center;
        margin-left: 5%;
        font-weight: 600;
    }

    h2 {
        padding: 20px;
    }

    .post-info {
        margin: 20px;
        padding: 20px;
        background: #DDE7F1;
        border-radius: 10px;
        width: 500px;

    }
</style>
@section('content')
<div class=" employer-profile">
      <!-- <h1>Employer Profile</h1> -->
      <img class="card img-fluid" width="100%" src="{{ asset('images/profile-cover.jpeg') }}" style="z-index: -1" alt="Profile Picture">
      <img src="{{ $user->profile_pic ? asset('uploads/profile_pics/' . $user->profile_pic) : asset('images/user.png') }}" style="margin-top: -100px; width: 200px; margin-left: 41%; z-index: 1;" class=" rounded-circle" alt="Profile Picture">
    <p class="name" >{{ $user->name }}</p>


    {{-- Check if the employer exists before accessing its properties --}}
    @if(auth()->user()->employer)

        @if(auth()->user()->employer->company_name && auth()->user()->employer->company_website)
            <h2>{{ auth()->user()->employer->company_name }}</h2>
            <p>{{ auth()->user()->employer->company_website }}</p>
        @endif

    @endif

    <h2>Your Posts</h2>
    @if($posts->isEmpty())
    <p>No posts available.</p>
    @else
    @foreach($posts as $post)
    <div class="post-info">
            <p>{{ $post->title }}</p>
            <p>Application Deadline: <span>{{ $post->application_deadline }}</span></p>
            <a class="btn btn-success" href="{{ route('posts.show', ['post' => $post->id]) }}">View Post</a>
            @if($post->applications->count() > 0)
    <a class="btn btn-success" href="{{ route('posts.applications', $post->id) }}">View Applications</a>
    @endif                        
</div>
    @endforeach
    
    @endif
    
</div>
  
@endsection


