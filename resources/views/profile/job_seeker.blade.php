
@extends('layouts.app')

<style>
    .card-2 {
        padding: 20px;
    }

    .header-content {
        padding: 20px;
        border: 1px solid #999;
        border-radius: 10px;
    }
    
    .header-content-flex {
        display: flex;
        margin-bottom: 20px;

    }

    .header-paragraph {
        margin-left: 20px;
    }
    .header-btn {
        text-decoration: none;
        background-color: #E9A53F;
        color: #fff;
        padding: 8px;
        border-radius: 20px;
        margin-left: 70px;
    }

    .info {
        border: 1px dashed #999;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 10px;
    }

    .info strong {
        background: green;
        color: #fff;
        border-radius: 20px;
        padding: 5px;
    }

</style>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <!-- <img src="{{ asset('uploads/profile_pics/' .$job_seeker->profile_pic) }}" class="card-img-top img-fluid rounded-circle" alt="Profile Picture"> -->
                <img src="{{asset('images/seeker-cover.jpeg')}}" class="card-img-top img-fluid" alt="">
                <img src="{{ $job_seeker->profile_pic ? asset('uploads/profile_pics/' . $job_seeker->profile_pic) : asset('images/user.png') }}" style="width: 200px; margin: auto; margin-top: -100px;" class="card-img-top rounded-circle" alt="Profile Picture">
                 
                <div class="card-body text-center">
                    <h4 class="card-title">{{ auth()->user()->name }}</h4>
                    <p class="card-text">{{ $job_seeker->bio }}</p>
    <a href="{{ route('profile.editJobSeeker', auth()->user()->job_seeker->id) }}">Edit Profile</a>
    @if(Auth::user() && Auth::user()->role === 'job_seeker')
    <!-- Only job seekers can see these links -->
    <p>  <a href="{{ route('applications.status') }}" class="btn btn-primary" style="margin-top: 10px; " >View All Your Applications</a></p>
@endif
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-2">
                <div class="header">
                    <h3>Suggested for you</h3>
                    <div class="header-content">
                        <div class="header-content-flex">
                        <img src="{{asset('images/star.svg')}}" alt="">
                        <div class="header-paragraph">
                            <h5>Enhance your profile with the help of AI
                            </h5>
                            <p>Stand out for almost 2x as many opportunities with a stronger profile.</p>
                            
                        </div>
                    </div>
                    <a class="header-btn" href="#">Try Premium for free</a>
                    </div>
                </div>
                
                <div class="card-body">
                    <p><strong>About</strong></p>
                    <p>Professional skilled in both front-end and back-end development, with technologies like HTML, CSS, JavaScript, and frameworks such as Angular for the front-end, while utilizing server-side languages like PHP for the back-end.</p>
                    <div class="info">
                        <p><strong>Skills</strong></p>
                        <p>{{ $job_seeker->skills }}</p>
                    </div>
                    <div class="info">
                        <p><strong>Phone</strong></p>
                        <p>{{ $job_seeker->phone }}</p>
                    </div>
                    <div class="info">
                        <p><strong>Location</strong></p>
                        <p>{{ $job_seeker->location }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
