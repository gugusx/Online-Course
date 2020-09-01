<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{asset('assets/hafecs_oc.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HAFECS Online Course</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <link href="{{asset('assets/new/css/bootstrap.min.css')}}" rel="stylesheet" />

    <link href="{{asset('assets/new/css/animate.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/new/css/font-awesome.min.css')}}" rel="stylesheet"/>

    <link href="{{asset('assets/new/css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>

    <!--rangesliderPlugin -->
    <link href="{{asset('assets/new/rangeslider/ion.rangeSlider.css')}}" rel="stylesheet" />
    <link  href="{{asset('assets/new/rangeslider/ion.rangeSlider.skinHTML5.css')}}" rel="stylesheet">

    <link href="{{asset('assets/new/new-style.css')}}" rel="stylesheet"/>

    <link href="{{asset('assets/new/css/demo.css')}}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{asset('assets/slick/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/slick/slick-theme.css')}}">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
    <link href="{{asset('assets/new/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/new/js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
</head>

<body>

    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                

                    <!-- Branding Image -->
                    <br>
                    <div class="logo hidden-xs">
                        <a href="/" class="simple-text">
                        <img src="{{ asset('logo.png')}}" alt="Logo" width="120px"></a> | <a href="{{route('forum.index')}}"><strong style="color: #2F4799;">FORUM</strong></a> 
                    </div>
      
   
                 
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color: #2F4799;">
                                    {{ Auth::user()->name }} <span class="caret" ></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                    <a class="dropdown-item" href="#" style="color: #444;">
                                        {{ __('Profil') }}
                                    </a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Keluar
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
        @include('layouts.info')
        </div>
        @yield('content')
    </div>

     <!-- Script -->
     <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
   
    
    @yield('js')
</body>
</html>
