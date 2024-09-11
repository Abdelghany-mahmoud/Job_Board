@extends('layouts.app')
<style> 
    form button {
        margin-top: 20px;  
    }
</style>
@section('content')
    <div class="container">
        <h1>Edit Comment</h1>

        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" required>{{ old('content', $comment->content) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Comment</button>
        </form>

        <a href="{{ route('posts.show', $comment->commentable_id) }}" class="btn btn-secondary">Back to Post</a>
    </div>
@endsection
