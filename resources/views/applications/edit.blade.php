@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Application</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('applications.update', $application->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="content">Application Content</label>
            <textarea name="content" id="content" class="form-control" rows="5">{{ $application->content }}</textarea>
        </div>

        <div class="form-group">
            <label for="expected_salary">Expected Salary</label>
            <input type="number" name="expected_salary" id="expected_salary" class="form-control" value="{{ $application->expected_salary }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Application</button>
    </form>
</div>
@endsection