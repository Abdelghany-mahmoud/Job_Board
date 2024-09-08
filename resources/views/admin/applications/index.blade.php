@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>All Applications</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($applications->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Applicant</th>
                        <th>Job Title</th>
                        <th>Content</th>
                        <th>Expected Salary</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                        <tr>
                            <td>{{ $application->user->name }}</td>
                            <td>{{ $application->post->title }}</td>
                            <td>{{ $application->content }}</td>
                            <td>{{ $application->expected_salary }}</td>
                            <td>{{ $application->status }}</td>
                            <td>
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

            {{ $applications->links() }} <!-- For pagination -->
        @else
            <p>No applications found.</p>
        @endif
    </div>
@endsection
