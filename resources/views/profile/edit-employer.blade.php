<form action="{{ route('profile.updateEmployer', $employer->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <!-- Input for name (from the User model) -->
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $employer->user->name }}" required>
    </div>

    <!-- Input for profile picture -->
    <input type="file" name="profile_pic">

    <!-- Submit button -->
    <button type="submit">Update Profile</button>
    
</form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

