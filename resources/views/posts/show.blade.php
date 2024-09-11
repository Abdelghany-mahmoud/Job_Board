@extends('layouts.app')
<style>

    .content {
        border: 1px solid #E8E8E8;
        width: 90%;
        margin: auto;
        border-radius: 10px; 
        font-size: 16px;
    }
    
    .post-info {
        padding: 20px;
        
    }

    div a {
        text-decoration: none;
    }

    h1 {
        background: #2386C8;
        color: #fff !important;
        padding: 15px;
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
    }
    .tech li , .work-type {
        display: inline;
        list-style: none;
        margin: 10px;
        background: #DDE7F1;
        padding: 3px 5px;
        border-radius: 5px;
    }
    .salary {
        background: #E7A33E;
        color: #DDE7F1;
        padding: 3px 5px;
        border-radius: 5px;
    }
    .view-btn {
        margin-left: 30px;
    }
    .btns {
        margin-top: 40px;
        margin-bottom: 40px;
    }
    .edit, .delete {
        margin-bottom: 30px;
    }
    .delete {
        margin-left: 30px;
    }
    textarea {
        width: 500px;
        height: 100px;
        outline: none;
        border-radius: 10px;
    }
    .view-btn2 {
        color: blue !important;
        margin-bottom: 20px;

    }

</style>
@section('content')
<div class="content">
    <h1>{{ $post->title }}</h1>
   <div class="post-info">
   <p>{{ $post->description }}</p>
    <p>Posted by:
        <a href="{{ route('profile.show', ['id' => $post->user->id]) }}">
            {{ $post->user->name }}
        </a>
        on {{ $post->created_at ? $post->created_at->format('M d, Y') : 'Date not available' }}
    </p>
    <p><span class="work-type"> {{$post->work_type}}</span> </p>
    <p>Application Deadline: <span> {{$post->application_deadline}}</span> </p>
    <p>Salary: <span>From </span><span class="salary">{{$post->min_salary}} </span><span> To </span> <span class="salary">{{$post->max_salary}}</span></p>

    <h3 style="margin-bottom: 20px;" >Associated Technologies</h3>
    <ul class="tech">
        @foreach ($post->technologies as $technology)
        <li>{{ $technology->name }}</li>
        @endforeach
    </ul>

    <!-- Check if the authenticated user is the creator of the post -->
    @if (Auth::id() === $post->user_id)
   <div class="btns">
   <a class="btn btn-secondary" href="{{ route('posts.edit', $post->id) }}">Edit Post</a>

    <a class="btn btn-success view-btn" href="{{ route('posts.applications', $post->id) }}">View Applications</a>

   </div>

    @endif
    <!-- Show link -->
    @if(Auth::user() && Auth::user()->role === 'job_seeker')
    <!-- Only job seekers can see these links -->
    <a href="{{ route('applications.user.post', $post->id) }}" class="btn view-btn2">View Your Applications on This Post</a>
    <a href="{{ route('applications.status') }}" class="btn view-btn2">View All Your Applications</a>
    @endif

    @if(Auth::user() && Auth::user()->role === 'admin')
    <!-- Only admins can see these links -->
    <a href="{{ route('admin.applications.show', $post->id) }}" class="btn btn-primary">View All Applications on This Post (Admin)</a>
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
        <a class="edit btn btn-secondary" href="{{ route('comments.edit', $comment->id) }}">Edit</a>

        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="delete btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
        </form>
        @endif
    </div>
    @endif
    @endforeach
    {{ $comments->links() }}

    @endif



    @auth
    <form action="{{ route('newComment.store', $post) }}" method="POST">
        @csrf
        <textarea name="content" required></textarea>
       <span> <button class="btn btn-primary" type="submit">Add Comment</button></span>
    </form>
    @if(auth()->user()->role != 'job_seeker')
    <div class="alert alert-warning">
        Employers and Admins are not allowed to apply for jobs.
    </div>
    @elseif (auth()->user()->application && auth()->user()->application->count() >= 1 && auth()->user()->application->post_id == $post->id)

    <div class="alert alert-warning">
        You already applied
    </div>
    @else
    <a href="{{ route('applications.create', $post->id) }}" class="btn btn-primary">Apply for this Job</a>
    @endif

    @else
    <p><a class="btn btn-primary" href="{{ route('login') }}">Log in</a> To apply for this Job and add comments.</p>
    @endauth

</div>
   </div>
<div class="container">
    <a style="margin-top: 20px;" href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
</div>
@endsection