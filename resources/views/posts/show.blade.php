@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->description }}</p>
    <p>Posted by:
        <a href="{{ route('PostCreatorProfile.show',$post->user_id)}}">
            {{ $post->user->name }}
        </a>
        on {{ $post->created_at ? $post->created_at->format('M d, Y') : 'Date not available' }}
    </p>
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

    <!-- Check if the authenticated user is the creator of the post -->
    @if (Auth::id() === $post->user_id || Auth::user() && Auth::user()->role === 'admin')
    <a class="btn btn-secondary" href="{{ route('posts.edit', $post->id) }}">Edit Post</a>
    <br>
    <a class="btn btn-secondary" href="{{ route('posts.applications', $post) }}">View Applications</a>


    @endif
    <!-- Show link -->
    @if(Auth::user() && Auth::user()->role === 'job_seeker')
    <!-- Only job seekers can see these links -->
    <a href="{{ route('applications.user.post', $post->id) }}" class="btn btn-primary">View Your Applications on This Post</a>
    <a href="{{ route('applications.status') }}" class="btn btn-primary">View All Your Applications</a>
    @endif


    <h3>Comments</h3>
    @if ($comments->isEmpty())
    <p>No comments yet.</p>
    @else
    @foreach ($comments as $comment)
    {{-- Show the comment only if it's visible to others or the user is the comment owner --}}
    @if ($comment->visible_to_others || auth()->id() === $comment->user_id)
    <div>
        {{-- Display the commenter's profile link --}}
        <strong>
            <a href="{{ route('profile.show', ['id' => $comment->user->id]) }}">
                {{ $comment->user->name }}
            </a>
        </strong> commented:

        {{-- Display the comment content --}}
        <p>{{ $comment->content }}</p>
        <p>Commented at: {{ $comment->created_at }}</p>

        {{-- If the logged-in user is the comment owner, allow editing and deleting --}}
        @if (auth()->id() === $comment->user_id)
        <a class="btn btn-primary" href="{{ route('comments.edit', $comment->id) }}">Edit</a>

        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-primary" type="submit" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
        </form>
        @endif
    </div>
    @endif
    <hr>
    @endforeach
    {{ $comments->links() }}

    @endif



    @auth
    <form action="{{ route('newComment.store', $post) }}" method="POST">
        @csrf
        <textarea name="content" required></textarea>
        <button class="btn btn-primary" type="submit">Add Comment</button>
    </form>
    @if(auth()->user()->role === 'employer' || auth()->user()->role === 'admin')
    <div class="alert alert-warning">
        Employers and Admins are not allowed to apply for jobs.
    </div>
    @elseif (auth()->user()->role === 'job_seeker' && auth()->user()->application && auth()->user()->application->count() >= 1 && auth()->user()->application->post_id == $post->id)
    <div class="alert alert-warning">
        You already apllied
    </div>
    @else
    <a href="{{ route('applications.create', $post->id) }}" class="btn btn-primary">Apply for this Job</a>
    @endif

    @else
    <p><a class="btn btn-primary" href="{{ route('login') }}">Log in</a> To apply for this Job and add comments.</p>
    @endauth

    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
</div>
@endsection