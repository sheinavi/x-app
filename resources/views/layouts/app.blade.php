<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:image" content="{{ $social_thumbnail ?? 'https://source.unsplash.com/hhq1Lxtuwd8/600x300' }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">

    <title> {{config('app.name', 'Quiz Crashers')}} : {{ $title ?? 'Home of short and fun quizzes' }} </title>
    <meta name="description" content="{{ $meta_description ?? 'Take short tests of memory, pop culture, trivia. 5 to 10 questions per quiz. Share it with your friends and compare results. No sign up needed.' }}" />
    <meta property="og:description" content="{{ $meta_description ?? 'Take short tests of memory, pop culture, trivia. 5 to 10 questions per quiz. Share it with your friends and compare results. No sign up needed.' }}" />
    <meta name="keywords" content="Short, Quizzes, Fun, Online, Free, No Sign up, Social, Trivia, Movies, History, Music">
    <meta name="author" content="Sheina Paclibar">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    @stack('styles')
    
    @production
        
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-W1SPBQ8BJ9"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-W1SPBQ8BJ9');
        </script>
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5860800463223457" crossorigin="anonymous"></script>
    @endproduction
    
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm" id="main-navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('images/logo.png')}}" id="main-logo" alt="{{ config('app.name', 'Quiz Crashers') }}">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav">
                        
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto" id="rightmost-menu">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item sr-only">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-outline-info text-dark" href="{{ route('register') }}"><i class="fas fa-plus-circle"></i> Create Your Own Quiz </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name ?? Auth::user()->email }}
                                </a>

                                

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    
                                    @hasanyrole('creator|admin')
                                        <a class="dropdown-item" href="{{route('admin.dashboard')}}">Create/Manage Tests</a>
                                    @endhasanyrole
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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

        <main class="pb-4">
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>

        <footer class="container-fluid p-3">
            <div class="row">
                <div class="col-md-8"> 
                    <div class="d-flex justify-content-start">
                        <a href="{{route('about')}}">About</a>&nbsp;|&nbsp;
                        <a href="{{route('privacy-policy')}}">Privacy Policy</a>&nbsp;|&nbsp;
                        <a href="{{route('contact')}}">Contact Us</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        {{config('app.name')}} {{date('Y')}}
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
