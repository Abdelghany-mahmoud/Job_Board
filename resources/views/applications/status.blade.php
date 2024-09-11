@extends('layouts.app')
<style>
    .update-btn {
        border: none;
        outline: none;
        border-radius: 5px;
        padding: 5px;
        display: block;
        margin-top: 10px;
    }
    /* textarea {
        display: block;
    } */
    .btns {
        margin: 10px;
    }
</style>
@section('content')

<div class="container">
<h1>Your Applications</h1>

@if (session('success'))
<p>{{ session('success') }}</p>
@endif

@if ($applications->count() > 0)

<table class="table">
    <thead>
        <tr>
            <th>Post Title</th>
            <th>Status</th>
            <th>content</th>
            <th>Expected Salary</th>
            <th>Reply</th>
            <th>Applied At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($applications as $application)
        <tr>
            <td>{{ $application->post->title }}</td>
            <td>{{ $application->status }}</td>
            <td>{{ $application->content }}</td>
            <td>{{ $application->expected_salary }}</td>
            <td>{{ $application->reply ?? 'No reply yet' }}</td>
            <td>{{ $application->created_at->format('d-m-Y H:i') }}</td>
            <td>
                @if ($application->status == 'pending')
                <form action="{{ route('applications.update', $application->id) }}" method="POST">
                    @csrf
                    <textarea name="reply">{{ $application->reply }}</textarea>
                    <button class="update-btn btn btn-success" type="submit">Update Reply</button>
                    <a href="{{ route('applications.edit', $application->id) }}" class="btns btn btn-warning">Edit</a>
                    <button type="submit" class="btns btn  btn-danger" onclick="return confirm('Are you sure?')">Delete</button>

                </form>
                @else
                <span>Action Not Available</span>
                @endif


                <!-- Link to edit application -->

                <!-- Delete form -->
                <form action="{{ route('applications.destroy', $application->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
{{ $applications->links() }}
@else
<p>You have no applications yet.</p>
@endif
</div>
@endsection