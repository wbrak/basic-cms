@extends('admin.master')

@section('title', Lang::get('User Permissions'))

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard') /</a>
	<a href="{!! url('/admin/users/all') !!}"><i class="fas fa-user-friends"></i> @lang('Users') /</a>
	<a href="{!! url('/admin/user/'.$user->id.'/permissions') !!}"><i class="fas fa-user-shield"></i> @lang('Permissions')</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="page-user">
		<form action="{!! url('/admin/user/'.$user->id.'/permissions') !!}" method="POST">
			@csrf

			<div class="row">
				@foreach(user_permissions() as $key => $value)
				<div class="col-md-4 d-flex">
					<div class="panel shadow">
						<div class="header">
							<h2 class="title">{!! $value['icon'] !!} {!! $value['title'] !!}</h2>
						</div>

						<div class="inside">
							@foreach($value['keys'] as $k => $v)
							<div class="form-check">
								<input class="form-check-input" name="{!! $k !!}" type="checkbox" value="true" id="flexCheckDefault" @if(kvfj($user->permissions, $k)) checked @endif>
								<label class="form-check-label" for="flexCheckDefault">{!! $v !!}</label>
							</div>
							@endforeach
						</div>

					</div>
				</div>
				@endforeach
			</div>

			<div class="row mtop16">
				<div class="col-md-12">
					<div class="panel shadow">
						<div class="inside">
							<input type="submit" value="@lang('Save')" class="btn btn-permissions">
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

</div>
@endsection