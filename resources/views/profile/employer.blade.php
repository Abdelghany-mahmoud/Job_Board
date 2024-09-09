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
    font-weight: 600;
 }
</style>
@section('content')
  <div class="employer-profile">
      <!-- <h1>Employer Profile</h1> -->
      <img class="card img-fluid" width="100%" src="{{ asset('images/profile-cover.jpeg') }}" style="z-index: -1" alt="Profile Picture">
      <img style="width: 200px; margin-left: 39%; margin-top: -100px; z-index: 1;" src="{{ $user->profile_pic ? asset('uploads/profile_pics/' . $user->profile_pic) : asset('images/user.png') }}" style="width: 200px; margin: auto; margin-top: -100px;" class="card-img-top rounded-circle" alt="Profile Picture">
      <p class="name" >{{ $user->name }}</p>

      <!-- <img src="{{ asset($user->profile_pic) }}" alt="Profile Picture"> -->
     <div class="info">
      <a style="text-decoration: none !important" class="btn btn-primary text-light" href="{{ route('profile.editEmployer', auth()->user()->employer->id) }}">Edit Profile</a>



    <h2>{{ auth()->user()->employer->company_name }}</h2>
    <p>{{ auth()->user()->employer->company_website }}</p>

    <h2>Your Posts</h2>
    @foreach($posts as $post)
        <p>{{ $post->title }}</p>
        <p>Application Deadline: <span>{{ $post->application_deadline }}</span></p>
        <a class="btn btn-success" href="{{ route('posts.show', ['id' => $post->id]) }}">View Post</a>
        



    @endforeach
  </div>
     </div>
@endsection
