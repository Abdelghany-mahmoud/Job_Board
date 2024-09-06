
@extends('layouts.app')

@section('content')

<div class="container">
<form class="form " action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')

<div class="form-group">    <label for="title">Title:</label>
    <input type="text" name="title" id="title" value="{{ $post->title }}" required>
</div>
<div class="form-group">    <label for="description">Description:</label>
    <textarea name="description" id="description" required>{{ $post->description }}</textarea>
</div>
<div class="form-group">    <label for="work_type">Work Type:</label>
    <input type="text" name="work_type" id="work_type" value="{{ $post->work_type }}" required>
</div>
<div class="form-group">    <label for="application_deadline">Application Deadline:</label>
    <input type="date" name="application_deadline" id="application_deadline" value="{{ $post->application_deadline }}" required>
</div>
<div class="form-group">    <label for="min_salary">Min Salary:</label>
    <input type="number" name="min_salary" id="min_salary" value="{{ $post->min_salary }}" required>
</div>
<div class="form-group">    <label for="max_salary">Max Salary:</label>
    <input type="number" name="max_salary" id="max_salary" value="{{ $post->max_salary }}" required>
</div>
<div class="form-group">    <h3>Associated Technologies</h3>
    @foreach($technologies as $technology)
        <input type="c</div>heckbox" name="technologies[]" value="{{ $technology->id }}" 
        {{ in_array($technology->id, $selectedTechnologies) ? 'checked' : '' }}>
        <label for="technology">{{ $technology->name }}</label>
    @endforeach

    <button type="submit">Update Post</button>
</form>


</div>
@endsection