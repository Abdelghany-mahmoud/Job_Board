<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Fonts -->

  <link rel="dns-prefetch" href="//fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <!-- Custom CSS for Centering Navbar Links -->
  <style>
    a {
      cursor: pointer;
    }

    .navbar-nav {
      margin: 0 auto;
    }

    .navbar-nav-center {
      display: flex;
      justify-content: center;
      flex-grow: 1;
      font-size: 16px;
    }

    .navbar-nav-center a {
      margin-left: 15px;
      font-weight: bold;
      color: #717070;
    }
  </style>
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/posts') }}">
          <img src="{{ asset('logos/logo.png') }}" width="120" alt="{{ config('app.name') }}">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Centered Links -->
          <div class="navbar-nav-center">
            <ul class="navbar-nav">
              <!-- Home Link -->
              <li class="nav-item">
                <a class="nav-link menu" href="{{ route('posts.index') }}">{{ __('Home') }}</a>
              </li>
              <!-- Jobs Link -->
              <li class="nav-item">
                <a class="nav-link menu" href="{{ route('posts.index') }}">{{ __('Jobs') }}</a>
              </li>
              <!-- Notifications Link -->
              <li class="nav-item">
                <a class="nav-link menu" href="#">{{ __('Notifications') }}</a>
              </li>
              <!-- Messaging Link -->
              <li class="nav-item">
                <a class="nav-link menu" href="#">{{ __('Messaging') }}</a>
              </li>

            </ul>
          </div>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ms-auto">
            @if(Auth::user() && Auth::user()->role === "employer")
            <li style="margin-right: 50px;" class="nav-item">
              <a style="background-color: #4285F4; color: #fff; padding: 8px 20px; border-radius: 5px; font-weight: 500; " class="nav-link" href="{{ route('posts.create') }}">{{ __('Post Job') }}</a>
            </li>
            @endif
            <!-- Authentication Links -->
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="z-index: 4;">
                <a class="dropdown-item" href="{{ route('profile.show') }}">{{ __('Profile') }}</a>
                <a class="dropdown-item" href="#">{{ __('Settings') }}</a>
                <a class="dropdown-item" href="#">{{ __('Help') }}</a>
                <a class="dropdown-item" href="#">{{ __('Edit Profile') }}</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <main class="py-4">
      @yield('content')
    </main>
    <div class="py-4">
      @yield('edit-profile')
    </div>
  </div>
</body>

</html>