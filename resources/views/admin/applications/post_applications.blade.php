@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Applications for Post: {{ $applications->first()->post->title }}</h1>

        @if ($applications->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Applicant</th>
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
                            <td>{{ $application->content }}</td>
                            <td>{{ $application->expected_salary }}</td>
                            <td>{{ $application->status }}</td>
                            <td>
                                <!-- Delete form -->
                                <form action="{{ route('admin.applications.destroy', $application->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No applications found for this post.</p>
        @endif
    </div>
@endsection
