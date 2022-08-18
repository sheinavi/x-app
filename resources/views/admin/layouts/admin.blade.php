<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>{{ $page_title ?? config('app.name') }}</title>

    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/admin/sb-admin-2.css')}}" rel="stylesheet">
    
    @stack('styles')
    
  </head>
  <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('admin.layouts.nav')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            @include('admin.layouts.topnav')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                        <!-- Page Heading -->
                        @yield('page-header')

                        <!-- Content Row -->
                        <div class="card p-3">
                            @yield('content')
                        </div>
                </div>
            </div>
        </div>
    </div>

    
    <script src="{{asset('js/app.js')}}" ></script>
    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery-easing/jquery.easing.min.js')}}"></script>
    
    <script src="{{asset('js/admin/sb-admin-2.min.js')}}"></script>

    @stack('scripts')
  </body>
</html>