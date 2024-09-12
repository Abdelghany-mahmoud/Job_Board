@extends('layouts.app')

@section('content')
<div class="col-11 m-auto">
@foreach($posts as $post)
  <div style="display: flex; justify-content: space-between;" class="job-post">
    <!-- Company Logo and Name -->
    <div>
      <div class="d-flex align-items-center mb-3">
        <!-- <img src="{{ asset('logos/1.jpeg') }}" alt="Company Logo" class="job-logo"> -->
        
          <span style="font-size: 1.2rem; color: #0046B2;  cursor: pointer;"> {{ ucwords($post->title) }} </span>
        
      </div>
      <!-- <span class="company-name">{{ $post->user->name }} </span> -->

      <span>{{ $post->location }}</span>
      <p> <span style="color:#709466;">{{ $post->created_at->diffForHumans() }}</span></p>
      <p style="margin-top: 10px;">Application Deadline: {{ \Carbon\Carbon::parse($post->application_deadline)->format('M d, Y') }}</p>
      <p style="margin-top: 10px;">deleted at: {{ \Carbon\Carbon::parse($post->deleted_at)->format('M d, Y') }}</p>

      <span>Technologies Needed:</span>
      @foreach($Technologies_post as $Technology_post)
      @if($post->id == $Technology_post->post_id)
      <span style="background: #f1f1f1; padding: 4px 6px; border-radius: 5px;">{{ $Technology_post->technology->name }}</span>
      @endif
      @endforeach

      <p style="margin-top: 10px;">
        <span style="background-color: #EBEDF0; padding: 4px 6px; border-radius: 5px;">{{ $post->work_type }}</span>
      </p>
      <p> Posted by: <span>{{ $post->user->name }}</span> </p>
    </div>
  </div>
  @endforeach
  </div>
@endsection