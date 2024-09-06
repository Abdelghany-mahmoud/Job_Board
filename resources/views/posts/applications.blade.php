<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Applications</title>
</head>
<body>
    <h1>Applications for Post: {{ $post->title }}</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Applicant Name</th>
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
                    <td>{{ $application->status }}</td>
                    <td>{{ $application->reply ?? 'No reply yet' }}</td>
                    <td>{{ $application->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        @if ($application->status == 'pending')
                            <form action="{{ route('applications.reply', $application->id) }}" method="POST">
                                @csrf
                                <textarea name="reply">{{ $application->reply }}</textarea>
                                <button type="submit">Reply</button>
                            </form>
                            <form action="{{ route('applications.approve', $application->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit">Approve</button>
                            </form>
                            <form action="{{ route('applications.deny', $application->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit">Deny</button>
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
