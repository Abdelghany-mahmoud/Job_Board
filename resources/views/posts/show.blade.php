@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->description }}</p>
        <p>Posted by: {{ $post->user->name }} on {{ $post->created_at ? $post->created_at->format('M d, Y') : 'Date not available' }}</p>
        <p>work_type: <span> {{$post->work_type}}</span> </p>
        <p>application_deadline: <span> {{$post->application_deadline}}</span> </p>
        <p>min_salary: <span> {{$post->min_salary}}</span> </p>
        <p>max_salary: <span> {{$post->max_salary}}</span> </p>

        <h3>Associated Technologies</h3>
        <ul>
            @foreach ($post->technologies as $technology)
                <li>{{ $technology->name }}</li>
            @endforeach
        </ul>

        <h3>Comments</h3>
        @if ($comments->isEmpty())
            <p>No comments yet.</p>
        @else
            @foreach ($comments as $comment)
                <div>
                    <strong>{{ $comment->user->name }}</strong> commented:
                    <p>{{ $comment->content }}</p>
                    <p>Commented at: {{ $comment->created_at }}</p>

                    @if (auth()->id() === $comment->user_id)
                        <a class="btn btn-primary" href="{{ route('comments.edit', $comment->id) }}">Edit</a>

                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-primary" type="submit" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                        </form>
                    @endif
                </div>
            @endforeach

            {{ $comments->links() }}
        @endif

        @auth
            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf
                <textarea name="content" required></textarea>
                <button class="btn btn-primary" type="submit">Add Comment</button>
            </form>

            <a href="{{ route('applications.create', $post->id) }}" class="btn btn-primary">Apply for this Job</a>

        @else
            <p><a class="btn btn-primary" href="{{ route('login') }}">Log in</a> To apply for this Job and add comments.</p>
        @endauth

        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
    </div>
@endsection
