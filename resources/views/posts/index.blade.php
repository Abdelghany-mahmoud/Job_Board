@extends('layouts.app')
@section('content')
@if(session('success'))
<div class="alert alert-primary d-flex align-items-center mt-3" role="alert">
  <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
  </svg>
  <div>
    {{session('success')}}
  </div>
</div>
@endif
<div class="container col-6">
  <div class="p-3 text-center"> <a href="{{route('posts.create')}}" class="btn btn-success">Create new Post</a></div>

  @foreach($posts as $post)
  <p>Post creator: <span>{{$post->user->name}}</span></p>
  <p>title: <span>{{$post->title}}</span></p>
    <p>work_type: <span> {{$post->work_type}}</span> </p>
    <p>application_deadline: <span> {{$post->application_deadline}}</span> </p>
 
  Technologies :
  @foreach($Technologies_post as $Technology_post)
  @if($post->id == $Technology_post->post_id)
  <p><span> {{$Technology_post->technology->name}} </span> </p>
  @endif
  @endforeach
  <a class="btn btn-success"href="{{ route('posts.show', ['id' => $post->id]) }}">View Post</a>
  <hr>
  @endforeach
</div>
@endsection
