@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Admin Profile</h1>
    <p>Name: {{ $user->name }}</p>
    {{--
    <img src="{{ asset(auth()->user()->admin->profile_pic) }}" alt="Profile Picture">

    <a href="{{ route('profile.editAdmin', auth()->user()->admin->id) }}">Edit Profile</a>
    --}}
    <h2>Manage Post Requests</h2>
    @foreach($postsRequests as $postRequest)
    <p>{{ $postRequest->title }}</p>
    <a href="{{ route('approvePost', $postRequest->id) }}">Approve</a>
    <a href="{{ route('denyPost', $postRequest->id) }}">Deny</a>
    @endforeach

</div>

@endsection