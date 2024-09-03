<!-- <form action="{{ route('profile.update', $job_seeker->id) }}" method="POST"enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required>

    <label for="skills">Skills:</label>
    <input type="text" id="skills" name="skills" value="{{ $job_seeker->skills }}">

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" value="{{ $job_seeker->phone }}">

    <label for="location">Location:</label>
    <input type="text" id="location" name="location" value="{{ $job_seeker->location }}">

    <label for="bio">Bio:</label>
    <textarea id="bio" name="bio">{{ $job_seeker->bio }}</textarea>

    <label for="profile_pic">Profile Picture:</label>
    <input type="file" id="profile_pic" name="profile_pic">

    <button type="submit">Update Profile</button>
</form> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


</head>
<body>
    <div class="container">
        
    <form action="{{ route('profile.update', $job_seeker->id) }}" method="POST"enctype="multipart/form-data">
    @csrf
    @method('PUT')
  <div class="mb-3">
  <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" required>
  </div>

  <div class="mb-3">
  <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required>
  </div>

  <div class="mb-3">
  <label for="skills">Skills:</label>
  <input type="text" id="skills" name="skills" value="{{ $job_seeker->skills }}">
  </div>

  <div class="mb-3">
  <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" value="{{ $job_seeker->phone }}">

  </div>

  <div class="mb-3">
   <label for="location">Location:</label>
  <input type="text" id="location" name="location" value="{{ $job_seeker->location }}">
  </div>

  <div class="mb-3">
  <label for="bio">Bio:</label>
    <textarea id="bio" name="bio">{{ $job_seeker->bio }}</textarea>

  </div>

  <div class="mb-3">
  <label for="profile_pic">Profile Picture:</label>
    <input type="file" id="profile_pic" name="profile_pic">

  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
