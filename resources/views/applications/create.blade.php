@extends('layouts.app')
<style>
    form button {
        margin-top: 20px;
    }
</style>

@section('content')
    <div class="container">
        <h1>Apply for "{{ $post->title }}"</h1>

        @if(auth()->user()->role === 'employer')
            <div class="alert alert-warning">
                Employers cannot apply for jobs.
            </div>
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary">Back to Post</a>
        @else
            <form action="{{ route('applications.store') }}" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <div class="form-group">
                    <label for="content">Application Content</label>
                    <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="expected_salary">Expected Salary</label>
                    <input type="number" name="expected_salary" id="expected_salary" class="form-control" step="0.01" min="0">
                </div>

                <button type="submit" class="btn btn-primary">Submit Application</button>
            </form>

            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary">Back to Post</a>
        @endif
    </div>
@endsection
