<form action="{{ route('profile.updateEmployer', $employer->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="profile_pic">Profile Picture</label>
        <input type="file" name="profile_pic">
    </div>
    
    <!-- Add other fields as needed -->
    
    <button type="submit">Update Profile</button>
</form>
