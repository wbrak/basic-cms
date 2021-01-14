<!DOCTYPE html>
<html lang="{!! str_replace('_', '-', app()->getLocale()) !!}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<meta name="csrf-token" content="{!! csrf_token() !!}">
		<meta name="routeName" content="{!! Route::currentRouteName() !!}">
		@section('meta')
		@show

		<title>{!! Config::get('company.name') !!} | @yield('title')</title>

		<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.0/yeti/bootstrap.min.css" rel="stylesheet" integrity="sha384-chJtTd1EMa6hQI40eyJWF6829eEk4oIe7b3nNtUni7VxA3uHc/uIM/8ppyjrggfV" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="{!! url('css/admin.css?v='.time()) !!}">
		<link rel="shortcut icon" type="image/x-icon" href="{!! url('storage/faviconAdmin.ico') !!}">
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">

		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/447636fad2.js" crossorigin="anonymous"></script>
		<script src="{!! url('/js/admin.js?v='.time()) !!}"></script>
		<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

		<script>
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip()
			});
		</script>
        @livewireStyles
	</head>
<body>

	<div class="d-flex" id="wrapper">

	    <!-- Sidebar -->
	    <div class="bg-light border-right" id="sidebar-wrapper">
	        <div class="sidebar-heading">{!! Config::get('company.name') !!}</div>


            @livewire('admin-master')
	    </div>

	    <!-- /#sidebar-wrapper -->

	    <!-- Page Content -->
	    <div id="page-content-wrapper">

	    	<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
	        	<button class="btn btn-menu" id="menu-toggle"><i class="fas fa-bars"></i> @lang('View/Hide')</button>

	        	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	        	<span class="navbar-toggler-icon"></span>
	        	</button>

	        	<div class="collapse navbar-collapse" id="navbarSupportedContent">

		            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
			            <li class="nav-item active">
			              <a class="nav-link" href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard')<span class="sr-only">(current)</span></a>
			            </li>
			            <li class="nav-item">
			              <a href="{!! url('/') !!}" class="nav-link" target="_blank"><i class="fas fa-globe"></i>  @lang('Visit your Website')</a>
			            </li>
			            <li class="nav-item">
			              <a href="http://informaticocoruna.com" target="_blank" class="nav-link"><i class="fas fa-at"></i> @lang('Support')</a>
			            </li>

			            <li class="nav-item dropdown">

			                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@if(is_null(Auth::user()->avatar))
                                <img src="{!! asset('storage/default-avatar.png') !!}" class="nav-img rounded-circle">
                                @else
                                <img src="{!! asset('storage/profiles/'.Auth::id().'/av_'.Auth::user()->avatar) !!}" class="nav-img rounded-circle">
                                @endif{!! Auth::user()->nick !!}</a>

			                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
			                	<h3 class="dropdown-header">@lang('My account')</h3>
			                	<a class="dropdown-item" href="{!! url('/admin/user/profile') !!}"><i class="fas fa-tools"></i> @lang('My profile (config)')</a>
			                <div class="dropdown-divider"></div>
			                	<a class="dropdown-item" href="{!! url('/logout') !!}"><i class="fas fa-sign-out-alt"></i> @lang('Logout')</a>
                            </div>
			            </li>
		            </ul>
	        	</div>
	    	</nav>

		    <div class="container-fluid">
				<nav aria-label="breadcrumb shadow">
					<ol class="breadcrumb">

						@section('breadcrumb')
						@show
					</ol>
				</nav>
			</div>

			@include('sweetalert::alert')

	        @section('content')
	        @show

		    <div class="copy mtop16">
		        <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">CreaTuWeb Copyright ©</span>
		        <?php
				    $copyYear = 2002;
				    $curYear = date('Y');
				      echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
				  ?> por<a xmlns:cc="http://creativecommons.org/ns#" href="https://alojatuweb.com" property="cc:attributionName" rel="cc:attributionURL">
				  	AlojaTuWeb</a>. @lang('License')
		        <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">CC BY-SA 4.0 <img alt="Licencia de Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" /></a>
                <div>Iconos diseñados por <a href="https://www.flaticon.es/autores/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.es/" title="Flaticon">www.flaticon.es</a></div>
		    </div>

	    </div>
	    <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Menu Toggle Script -->
    <script>
    	$("#menu-toggle").click(function(e) {
        	e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        });
    </script>
    @livewireScripts
</body>

</html>
