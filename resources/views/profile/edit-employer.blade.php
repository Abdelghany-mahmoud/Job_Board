<style>
 

    .container {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        padding: 20px;
        width: 70%;
        margin: auto;
        margin-top: 50px;
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
        display: block;
    }
    
    form button {
        background: green;
        border: none;
        outline: none;
        border-radius: 5px;
        padding: 8px;
        color: #fff;
        cursor: pointer;
        letter-spacing: .2px;
    }

</style>
<div class="container">
    
<form action="{{ route('profile.updateEmployer', $employer->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <!-- Input for name (from the User model) -->
    <div class="form-group">
        <label for="name">Name</label>
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

</div>
