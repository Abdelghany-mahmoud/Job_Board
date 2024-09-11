@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manage Post Requests</h2>
    @foreach($postsRequests as $postRequest)
    <p>{{ $postRequest->title }}</p>
    <a href="{{ route('approvePost', $postRequest->id) }}">Approve</a>
    <a href="{{ route('denyPost', $postRequest->id) }}">Deny</a>
    @endforeach

</div>

@endsection