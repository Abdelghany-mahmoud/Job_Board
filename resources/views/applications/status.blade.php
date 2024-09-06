<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Applications</title>
</head>
<body>
    <h1>Your Applications</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Post Title</th>
                <th>Status</th>
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
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    {{ $applications->links() }}
</body>
</html>
