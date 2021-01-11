<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{!! Config::get('company.name') !!} | @yield('title')</title>

	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.0/yeti/bootstrap.min.css" rel="stylesheet" integrity="sha384-chJtTd1EMa6hQI40eyJWF6829eEk4oIe7b3nNtUni7VxA3uHc/uIM/8ppyjrggfV" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ url('css/connect.css?v='.time()) }}">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/447636fad2.js" crossorigin="anonymous"></script>
</head>
<body>

	@section('content')

	@show

</body>
</html>
