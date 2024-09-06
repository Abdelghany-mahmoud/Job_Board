

<@extends('layouts.app')

@section('content')
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
@endsection
