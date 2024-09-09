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
