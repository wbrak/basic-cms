<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <meta name="keywords" content="@yield('meta_keywords')">
    <meta name="description" content="@yield('meta_description')">
    <meta name="robots" content="noindex o index">
    <meta name="links" content="follow o nofollow">
    <meta name="author" content="Nombre del autor">
    <meta name="copyright" content="Propietario del copyright">
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <title>{!! Config::get('company.name') !!} | @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.0/yeti/bootstrap.min.css" rel="stylesheet" integrity="sha384-chJtTd1EMa6hQI40eyJWF6829eEk4oIe7b3nNtUni7VxA3uHc/uIM/8ppyjrggfV" crossorigin="anonymous">
    <!-- Custom fonts for this template -->
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="{!! url('css/clean-blog.min.css?v='.time()) !!}">
    <link rel="shortcut icon" type="image/x-icon" href="{!! url('storage/favicon.ico') !!}">

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- Custom scripts for this template -->
    <script src="{!! url('/js/clean-blog.min.js?v='.time()) !!}"></script>
    <script src="https://kit.fontawesome.com/447636fad2.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{!! url('/') !!}">{!! Config::get('company.name') !!}</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{!! url('/') !!}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{!! url('/about') !!}">Acerca de ..</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{!! url('/contact') !!}">Contacto</a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-power-off"></i></a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ url('/login') }}">Acceso</a>
                                <a class="dropdown-item" href="{{ url('/register') }}">Registro</a>
                                @if (Route::has('login'))
                                @auth
                                <hr>
                                <a class="dropdown-item" href="{{ url('/logout') }}"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> Salir</a>
                                @else
                                @endauth
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Header -->

    @section('pager')
    @show

    <!-- Main Content -->

    @section('content')
    @show

    <hr>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <ul class="list-inline text-center">
                        <li class="list-inline-item">
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; {!! Config::get('company.name') !!} 2020</p>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
