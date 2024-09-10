@extends('layouts.app')

@section('content')
    <div class="container">
        @if($applications->first())
        <h1>Applications for Post: 
            {{ $applications->first()->post->title }}</h1>
            @endif

        @if ($applications->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Content</th>
                        <th>Expected Salary</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                        <tr>
                            <td>{{ $application->content }}</td>
                            <td>{{ $application->expected_salary }}</td>
                            <td>{{ $application->status }}</td>
                            <td>
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
        @else
            <p>You have no applications for this post.</p>
        @endif
    </div>
@endsection
