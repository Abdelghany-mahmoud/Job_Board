@extends('layouts.app')

<style>

    .edit-profile-flex {
        display: flex;
       
    }

    form label {
        color: gray;
        display: block;
        font-weight: 600;
    }

    form input {
        width: 500px;
        margin-bottom: 10px;
        padding: 10px;
        outline: none;
    }
    
    form textarea {
        margin: 1px;
        margin-bottom: 15px;
        width: 500px;
        outline: none;
    }

    form button {
        background: green;
        border: none;
        outline: none;
        border-radius: 5px;
        margin-left: 10px;
        padding: 6px;
        color: #fff;
        cursor: pointer;
    }

    .img {
        border-radius: 10px;
        height: 300px;
        width: 300px;
        position: relative;
        margin-left: 250px;
    }

    .img img {
        position: absolute;
        width: 100%;
    }

    .content {
        width: 350px;
        border: 1px solid #DFDEDA;
        border-radius: 5px;
        padding: 10px;
    }

    .content a {
        text-decoration: none;
        color: gray;
    }

</style>

@section('edit-profile')
<div class="edit-profile-flex container">
<form action="{{ route('profile.updateJobSeeker', $job_seeker->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="profile_pic">Profile Picture</label>
        <input type="file" name="profile_pic">
    </div>
    
    <!-- <div>
        <label for="linkedin_profile">LinkedIn Profile</label>
        <input type="url" name="linkedin_profile" value="{{ $job_seeker->linkedin_profile }}">
    </div> -->

    <div>
        <label for="skills">Skills</label>
        <input type="text" name="skills" value="{{ $job_seeker->skills }}">
    </div>

    <div>
        <label for="phone">Phone</label>
        <input type="text" name="phone" value="{{ $job_seeker->phone }}">
    </div>

    <div>
        <label for="location">Location</label>
        <input type="text" name="location" value="{{ $job_seeker->location }}">
    </div>

    <div>
        <label for="bio">Bio</label>
        <textarea name="bio">{{ $job_seeker->bio }}</textarea>
    </div>
    <a href="{{ route('applications.status') }}" class="btn btn-primary">View All Your Applications</a>

    <button type="submit">Update Profile</button>
</form>
<div class="img">
    <div class="content">
 
        <div>
            <h4>Job seeker guidance</h4>
            <p style="color: #E9A53F">Recommended based on your activity</p>
        </div>
        <div>
            <p>Explore our curated guide of expert-led courses, such as how to improve your resume and grow your network, to help you land your next opportunity.</p>
        </div>
        <a href="#">Show more</a>
    </div>
    <img src="{{asset('images/edit-img.jpeg')}}" alt="">
</div>

</div>
@endsection('edit-profile')
