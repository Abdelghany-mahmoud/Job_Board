@extends('layouts.app')
<style>
    form button {
        outline: none;
        border: none;
        border-radius: 5px;
        padding: 5px;
    }
</style>
@section('content')
    <div class="container">

     <h1>Applications for Post: {{ $post->title }}</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Applicant Name</th>
                <th>Application Content</th>
                <th>Expected Salary</th>
                <th>Status</th>
                <th>Reply</th>
                <th>Applied At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            
        @foreach ($applications as $application)
            <tr>
                <td>{{ $application->user->name }}</td>
                <td>{{ $application->content }}</td> <!-- Application content -->
                <td>{{ $application->expected_salary ? '$' . number_format($application->expected_salary, 2) : 'Not provided' }}</td> <!-- Expected salary -->
                <td>{{ $application->status }}</td>
                <td>{{ $application->reply ?? 'No reply yet' }}</td>
                <td>{{ $application->created_at->format('d-m-Y H:i') }}</td>
                <td>
                    @if ($application->status == 'pending')
                        <!-- Reply Form -->
                        <form action="{{ route('applications.reply', $application->id) }}" method="POST" style="margin-bottom: 5px;">
                            @csrf
                            <textarea name="reply" placeholder="Your reply">{{ $application->reply }}</textarea>
                            <button style="background: #4285F4; color: #ffffff;" type="submit">Reply</button>
                        </form>
                        <!-- Approve/Deny Actions -->
                        <form action="{{ route('applications.approve', $application->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button class="btn btn-success" type="submit">Approve</button>
                        </form>
                        <form action="{{ route('applications.deny', $application->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button style="margin-left: 10px;" class="btn btn-secondary" type="submit">Deny</button>
                        </form>
                    @else
                        <span>Action Not Available</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    {{ $applications->links() }}
    </div>
    @endsection
