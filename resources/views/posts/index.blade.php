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
        background-image: url('{{ asset('images/background.jpeg') }}');
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

    .container {
        position: relative;
        z-index: 10;
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
        border: 1px solid  #cd9837;;
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
    <div style="" class="container hero-div mx-auto text-center">
        <h1  class="text-5xl font-bold text-gray-800 mb-6">Discover the best jobs tailored to your skills</h1>
        <p class="text-gray-600 mb-8">Browse through thousands of job listings and apply today!</p>

        <!-- Search Form -->
        <form style="z-index: 99; position: relative;" action="{{ route('posts.index') }}" method="GET" class="search-form flex justify-center mb-8">
            <input style="z-index: 99;"
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search jobs by title, company, location, or tags..."
                class="form-control search-input"
            />
            <button style="z-index: 99;" type="submit" class="search-btn">
                Search Jobs
            </button>
        </form>
    </div>
</section>

<div class="bar"></div>
<div style="width: 90%;" class="container col-6">
        <div class="heading">
            <h2>Job Listings</h2>
           <div style="margin-top: 20px;">
           <span>Programming</span>
            <span class="tag">Design</span>
            <span class="tag">Machine Learning</span>
            <span class="tag">Finance</span>
            <span class="tag">Data Science</span>
            <span class="tag">Marketting</span>
            <span class="tag">Engineering</span>
            <span class="tag">Sales</span>
           </div>
        </div>

    @foreach($posts as $post)
        @php
           

            $companyLogos = ['1.jpeg', '2.jpeg', '3.jpeg', '5.jpeg', '6.jpeg', '7.jpeg', '8.jpeg', '9.jpeg'];
            $companyNames = ['Tech Corp', 'Innovate Solutions', 'Global Soft', 'Bright Future Inc'];
            $randomLogo = $companyLogos[array_rand($companyLogos)];
            $randomCompanyName = $companyNames[array_rand($companyNames)];

            $tags = ['Programming', 'Design', 'Marketing', 'Engineering', 'Machine Learning', 'Data Science', 'Finance', 'Sales', 'HR'];
            // Pick a random number of tags (between 1 and 4)
            $randomTags = array_rand(array_flip($tags), rand(1, 2));
            if (!is_array($randomTags)) {
                $randomTags = [$randomTags];  
            }
        @endphp
   
    
        <div style="display: flex; justify-content: space-between; cursor: pointer;" class="job-post">  
            <!-- Company Logo and Name -->
            <div>
            <div class="d-flex align-items-center mb-3">
                <img src="{{ asset('logos/' . $randomLogo) }}" alt="Company Logo" class="job-logo">
                <span style="font-size: 1.2rem; color: #0046B2;">{{ $post->title }}</span>
            </div>
            <span class="company-name">{{ $randomCompanyName }} - </span>

            <span>{{ $post->location }}</span>
           <p> <span style="color:#709466;">{{ $post->created_at->diffForHumans() }}</span></p>
            <p style="margin-top: 10px;">Application Deadline: {{ \Carbon\Carbon::parse($post->application_deadline)->format('M d, Y') }}</p>

            <span >Technologies Needed:</span>
            @foreach($Technologies_post as $Technology_post)
            @if($post->id == $Technology_post->post_id)
            <span style="background: #f1f1f1; padding: 4px 6px; border-radius: 5px;">{{ $Technology_post->technology->name }}</span>
            @endif
            @endforeach
            
            <p style="margin-top: 10px; " ><span style="background-color: #EBEDF0; padding: 4px; 6px; border-radius: 5px;">{{ $post->work_type }}</span></p>
            <!-- <p>Posted by: <span>{{ $post->user->name }}</span></p> -->

            </div>
            <div>
                <!-- Display Tags -->
                <ul class="tags">
                    @foreach($randomTags as $tag)
                        <li >{{ $tag }}</li>
                    @endforeach
                </ul>
            </div>
        
        </div>
    @endforeach
</div>
@endsection
