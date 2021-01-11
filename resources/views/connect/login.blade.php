@extends('connect.master')

@section('title', Lang::get('Login'))

@section('content')
<div class="box box-login shadow">
	<div class="header">
		<a href="{{ url('/') }}">
			<img src="{{ asset('storage/logo.png') }}">
		</a>
	</div>

	@if(Session::has('message'))
			<div class="container">
				<div class="mtop16 alert alert-{{ Session::get('typealert') }}" style="display:none;">
					{{ Session::get('message') }}
					@if ($errors->any())
					<ul>
						@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
					@endif
					<script>
						$('.alert').slideDown();
						setTimeout(function(){ $('.alert').slideUp(); }, 10000);
					</script>
				</div>
			</div>
		@endif

	<div class="inside">
		{!! Form::open(['url'=> '/login']) !!}
		<label for="email">@lang('E-Mail Address')</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<div class="input-group-text"><i class="fas fa-envelope"></i></div>
			</div>
			{!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
		</div>

		<label for="password" class="mtop16">@lang('Password')</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<div class="input-group-text"><i class="fas fa-lock"></i></div>
			</div>
			{!! Form::password('password', ['class' => 'form-control', 'required']) !!}
		</div>
		{!! Form::submit(Lang::get('Access Platform'), array('class' => 'btn btn-success mtop16')) !!}
		{!! Form::close() !!}

			<a href="{{ url('/register') }}"><button class="btn btn-outline-primary btn-register mtop16">@lang('Without account? Sign up')</button></a>
			<a href="{{ url('/recover') }}"><button class="btn btn-outline-warning btn-recover mtop16">@lang('Forgot Your Password?')</button></a>
	</div>
</div>
@stop