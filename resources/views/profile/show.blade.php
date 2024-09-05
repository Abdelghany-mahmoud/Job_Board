<!-- 
<a href="{{ route('profile.edit', $job_seeker->id) }}">Edit Profile</a>
<p>{{$job_seeker->id}}</p>
<p>{{$job_seeker->location}}</p> -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <img src="{{ asset('uploads/profile_pics/' .$job_seeker->profile_picture) }}" class="card-img-top img-fluid rounded-circle" alt="Profile Picture">
                <!-- <img src="{{ asset('storage/profile_pics/' . $job_seeker->profile_pic) }}" class="card-img-top img-fluid rounded-circle" alt="Profile Picture"> -->

                <div class="card-body text-center">
                    <h4 class="card-title">{{ auth()->user()->name }}</h4>
                    <p class="card-text">{{ $job_seeker->bio }}</p>
                    <a href="{{ route('profile.edit', $job_seeker->id) }}">Edit Profile</a>

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
</div>
@endsection
