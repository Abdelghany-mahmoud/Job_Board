@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Post New Job</h1>
    <form action="{{route('posts.update',$post)}}" method="POST" enctype='multipart/form-data'>
        @csrf
        @method('PUT')

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
            <label for="title">Title</label>
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="description" name="description" value="{{$post->description}}">
            <label for="description">Description</label>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="requirements" name="requirements" value="{{$post->requirements}}">
            <label for="requirements">Requirements</label>
            @error('requirements')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="responsibilities" name="responsibilities" value="{{$post->responsibilities}}">
            <label for="responsibilities">Responsibilities</label>
            @error('responsibilities')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <select class="form-select mb-3" aria-label="work_type" name="category_id">
                <option selected disabled>Choose Category</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            @error('work_type')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="location" name="location" value="{{$post->location}}">
            <label for="location">Location</label>
            @error('location')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="benefits" name="benefits"  value="{{$post->benefits}}">
            <label for="location">Benefits</label>
            @error('benefits')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <select class="form-select mb-3" aria-label="work_type" name="work_type">
                <option selected disabled>choose work type</option>
                <option value="remote">Remote</option>
                <option value="on_site">On-site</option>
                <option value="hybrid">Hybrid</option>
            </select>
            @error('work_type')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <h5>Technologies</h5>
        <div class="mb-3 d-flex justify-content-around col-4">
            @foreach ($technologies as $technology)
            <div>
                <input class="form-check-input" type="checkbox" id="{{$technology->name}}" name="technologies[]"
                value="{{ $technology->id }}"
                {{ in_array($technology->id, $selectedTechnologies) ? 'checked' : '' }}>
                <label class="form-check-label" for="{{$technology->name}}"> {{$technology->name}} </label>
            </div>
            @endforeach
            @error('technologies')
            <div class="alert alert-danger">{{ $message }} </div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="min_salary" name="min_salary" value="{{$post->min_salary}}">
            <label for="min_salary">Minimum Salary</label>
            @error('min_salary')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="max_salary" name="max_salary" value="{{$post->max_salary}}">
            <label for="max_salary">Maximum Salary</label>
            @error('max_salary')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="date" class="form-control" id="application_deadline" name="application_deadline" value="{{$post->application_deadline}}">
            <label for="application_deadline">Application Deadline</label>
            @error('application_deadline')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <input type="submit" value="Submit" class="btn btn-secondary">
    </form>
</div>
@endsection
