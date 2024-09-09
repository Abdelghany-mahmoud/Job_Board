@extends('layouts.app')

@section('content')

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
            <th>expected_salary</th>
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
                    <button type="submit">Update Reply</button>
                </form>
                @else
                <span>Action Not Available</span>
                @endif


                <!-- Link to edit application -->
                <a href="{{ route('applications.edit', $application->id) }}" class="btn btn-sm btn-warning">Edit</a>

                <!-- Delete form -->
                <form action="{{ route('applications.destroy', $application->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
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
@endsection