@extends('layouts.app')

@section('content')

<style>
  /* .color-gray {
            background-color: #f1f1f1;
        }
    
        .color-blue {
            background-color: #D7E9FB;
        }

        .color-green {
            background-color: #d3ffd3;
        } */

  .hero {
    background-image: url('{{ asset ("images/background.jpeg") }}');
    background-size: cover;
    width: 100%;
    height: 400px;
    position: relative;
    top: -25px;

  }

  .hero:after {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: rgb(0, 0, 0, .7);
    z-index: 1;

  }

  .hero .container {
    position: relative;
    z-index: 2;
  }

  .hero-div {
    top: 50px;
  }

  .hero-div h1 {
    color: #fff;
    font-size: 3rem;
    margin-bottom: 20px;
  }

  .hero-div p {
    color: #fff;
    font-size: 1.4rem;
    margin-bottom: 90px;
  }

  .search-input {
    background: #fff;
    border: 1px solid #fff;
    border-radius: 5px;
    padding: 15px;
    width: 600px;
    outline: none;
    color: #000;
    margin: auto;

  }

  .search-btn {
    background: #0A66C2;
    outline: none;
    border: none;
    border-radius: 5px;
    padding: 11px 15px;
    color: #fff;
    position: absolute;
    top: 5px;
    left: 750px;
  }

  .job-post {
    padding: 20px;
    margin-bottom: 10px;
    background: #fff;
    border: 1px solid #C6CDD0;
    transition: all .3s ease;

  }

  .job-post:hover {
    background: #f1f1f1;
  }

  .job-logo {
    width: 50px;
    height: 50px;
    margin-right: 10px;
    border-radius: 50%;
  }

  .company-name {

    font-size: 1rem;
  }

  .tags {
    list-style: none;
    padding: 0;
    margin-top: 10px;
  }

  .tags li {
    display: inline-block;
    background: #f1f1f1;
    color: black;
    padding: 5px 10px;
    border-radius: 4px;
    margin-right: 5px;
    margin-bottom: 5px;
  }

  .heading {
    margin-top: 20px;
    margin-bottom: 20px;
  }

  .heading .tag {
    margin: 5px;
  }

  .heading span {
    border: 1px solid #cd9837;
    ;
    padding: 5px;
    cursor: pointer;
    transition: all .3s ease;

  }

  .heading span:hover {
    background: #cd9837;
    color: #fff;
  }

  .bar {
    background: #cd9837;
    padding: 10px;
    margin-top: -30px;
  }
</style>

<!-- Hero Section -->
<section class="bg-gray-100 py-20 hero">
  <div class="container hero-div mx-auto text-center">
    <h1 class="text-5xl font-bold text-gray-800 mb-6"> Discover the best jobs tailored to your skills </h1>
    <p class="text-gray-600 mb-8"> Browse through thousands of job listings and apply today! </p>

    <!-- Search Form -->
    <form style="z-index:99; position: relative;" action="{{ route('posts.index') }}" method="GET"
    class="search-form flex justify-center mb-8">
      <input type="text" name="search" value="{{ request('search') }}" class="form-control search-input" 
      placeholder="Search jobs by title, company, location, or tags..." />
      <button type="submit" class="search-btn">Search Jobs</button>
    </form>
  </div>
</section>

<div class="bar"></div>

<div class="col-11 m-auto">
  <div class="heading">
    <h2>Job Listings</h2>

    <!-- <div style="margin-top: 20px;">
            <span>Programming</span>
            <span class="tag">Design</span>
            <span class="tag">Machine Learning</span>
            <span class="tag">Finance</span>
            <span class="tag">Data Science</span>
            <span class="tag">Marketting</span>
            <span class="tag">Engineering</span>
            <span class="tag">Sales</span>
        </div> -->
  </div>
  @if(session('success'))
  <div class="alert alert-primary d-flex align-items-center mt-3" role="alert">
    <div>
      {{ session('success') }}
    </div>
  </div>
  @endif

  @foreach($posts as $post)
  <div style="display: flex; justify-content: space-between;" class="job-post">
    <!-- Company Logo and Name -->
    <div>
      <div class="d-flex align-items-center mb-3">
        <!-- <img src="{{ asset('logos/1.jpeg') }}" alt="Company Logo" class="job-logo"> -->
        <a href="{{ route('posts.show',$post) }}" style="text-decoration: none;">
          <span style="font-size: 1.2rem; color: #0046B2;  cursor: pointer;"> {{ ucwords($post->title) }} </span>
        </a>
      </div>
      <!-- <span class="company-name">{{ $post->user->name }} </span> -->

      <span>{{ $post->location }}</span>
      <p> <span style="color:#709466;">{{ $post->created_at->diffForHumans() }}</span></p>
      <p style="margin-top: 10px;">Application Deadline: {{ \Carbon\Carbon::parse($post->application_deadline)->format('M d, Y') }}</p>

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

      @can("delete",$post)
      <form action="{{route('posts.destroy', $post)}}" method="POST" style="display: inline-block;">
        <input class='btn btn-danger' type="button" value="Delete" data-bs-toggle="modal" data-bs-target="#{{$post['id']}}">
        <div class="modal fade" id="{{$post['id']}}" tabindex="1" aria-labelledby="{{$post['id']}}Label" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Delete of {{$post['title']}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Are you sure you want to delete this post?
              </div>
              <div class="modal-footer">
                @csrf
                @method('delete')
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Confirm</button>
              </div>
            </div>
          </div>
        </div>
      </form>

      @endcan
    </div>
  </div>
  @endforeach
</div>
@endsection